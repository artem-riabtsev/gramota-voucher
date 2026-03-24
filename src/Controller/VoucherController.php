<?php

namespace App\Controller;

use App\Entity\Voucher;
use App\Form\PublicVoucherFormType;
use App\Service\PdfGenerator;
use App\Service\VoucherFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use App\Repository\VoucherTemplateRepository;

class VoucherController extends AbstractController
{
    public function __construct(
        private VoucherFactory $voucherFactory,
        private EntityManagerInterface $em
    ) {}

    #[Route('/voucher/create/{templateUuid}', name: 'voucher_create')]
    public function create(
        string $templateUuid,
        Request $request,
        VoucherTemplateRepository $templateRepository
    ): Response {
        $template = $templateRepository->findOneBy(['uuid' => $templateUuid]);

        if (!$template) {
            throw $this->createNotFoundException('Шаблон ваучера не найден');
        }

        $voucher = $this->voucherFactory->createFromTemplate($template);

        $form = $this->createForm(PublicVoucherFormType::class, $voucher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($voucher);
            $this->em->flush();

            return $this->redirectToRoute('voucher_show', [
                'uuid' => $voucher->getUuid()
            ]);
        }

        return $this->render('voucher/create.html.twig', [
            'form' => $form->createView(),
            'template' => $template,
            'voucher' => $voucher,
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
                'Content-Disposition' => 'attachment; filename="voucher-' . $voucher->getUuid() . '.pdf"'
            ]
        );
    }
}
