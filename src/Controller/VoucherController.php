<?php

namespace App\Controller;

use App\Entity\Voucher;
use App\Form\VoucherType;
use App\Service\PdfGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

class VoucherController extends AbstractController
{
    #[Route(['/', '/voucher/create'], name: 'voucher_create')]
    public function create(
        Request $request,
        EntityManagerInterface $em
    ): Response {

        $voucher = new Voucher();

        $form = $this->createForm(VoucherType::class, $voucher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $voucher->setJournal('Педагогика. Вопросы теории и практики');
            $voucher->setValidFrom(new \DateTime('2026-02-02'));
            $voucher->setValidTo(new \DateTime('2026-08-02'));
            $voucher->setCreatedAt(new \DateTime());

            $em->persist($voucher);
            $em->flush();

            return $this->redirectToRoute('voucher_show', [
                'uuid' => $voucher->getUuid()
            ]);
        }

        return $this->render('voucher/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/voucher/{uuid}', name: 'voucher_show')]
    public function show(Voucher $voucher): Response
    {
        return $this->render('voucher/show.html.twig', [
            'voucher' => $voucher
        ]);
    }

    #[Route('/voucher/{uuid}/download', name: 'voucher_download')]
    public function download(
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
