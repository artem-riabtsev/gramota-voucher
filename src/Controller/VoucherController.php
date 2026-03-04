<?php

namespace App\Controller;

use App\Entity\Voucher;
use App\Form\PublicVoucherFormType;
use App\Service\PdfGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use App\Repository\VoucherTypeRepository;

class VoucherController extends AbstractController
{
    #[Route(['/{journal_slug}', '/voucher/create/{journal_slug}'], name: 'voucher_create')]
    public function create(
        string $journal_slug,
        Request $request,
        EntityManagerInterface $em,
        VoucherTypeRepository $voucherTypeRepository
    ): Response {
        $voucherType = $voucherTypeRepository->findOneBy(['slug' => $journal_slug]);

        if (!$voucherType) {
            throw $this->createNotFoundException('Журнал не найден');
        }

        $voucher = new Voucher();
        $voucher->setVoucherType($voucherType);

        $form = $this->createForm(PublicVoucherFormType::class, $voucher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $voucher->setDiscount($voucherType->getDefaultDiscount());
            $voucher->setValidFrom(new \DateTime('2026-02-02'));
            $voucher->setValidTo(new \DateTime('2026-08-02'));
            $voucher->setCreatedAt(new \DateTime());

            $em->persist($voucher);
            $em->flush();

            return $this->redirectToRoute('voucher_show', [
                'uuid' => $voucher->getUuid()
            ]);
        };

        return $this->render('voucher/create.html.twig', [
            'form' => $form->createView(),
            'journal' => $voucherType->getName(),
        ]);
    }

    #[Route('/voucher/{uuid}', name: 'voucher_show')]
    public function show(
        #[MapEntity(mapping: ['uuid' => 'uuid'])]
        Voucher $voucher
    ): Response {
        return $this->render('voucher/show.html.twig', [
            'voucher' => $voucher
        ]);
    }

    #[Route('/voucher/{uuid}/download', name: 'voucher_download')]
    public function download(
        #[MapEntity(mapping: ['uuid' => 'uuid'])]
        Voucher $voucher,
        PdfGenerator $pdfGenerator
    ): Response {

        $pdfContent = $pdfGenerator->generate($voucher);

        return new Response(
            $pdfContent,
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="voucher.pdf"'
            ]
        );
    }
}
