<?php

namespace App\Controller;

use App\Entity\Voucher;
use App\Form\VoucherType;
use App\Service\PdfGenerator;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class VoucherController extends AbstractController
{
    #[Route(['/voucher/create', '/'], name: 'voucher_create')]
    public function create(
        Request $request,
        EntityManagerInterface $em,
        PdfGenerator $pdfGenerator,
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

            $pdfContent = $pdfGenerator->generate($voucher);
            $tempFile = '/tmp/voucher_pdf' . '/' . $voucher->getUuid() . '.pdf';
            file_put_contents($tempFile, $pdfContent);

            return $this->redirectToRoute('voucher_show', [
                'uuid' => $voucher->getUuid()
            ]);
        }

        return $this->render('voucher/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/voucher/{uuid}', name: 'voucher_show')]
    public function show(Voucher $voucher, MailerInterface $mailer): Response
    {
        $tempFile = '/tmp/voucher_pdf/' . $voucher->getUuid() . '.pdf';

        $message = (new Email())
            ->to($voucher->getEmail())
            ->subject('Ваш ваучер')
            ->text('Ваш ваучер')
            ->attachFromPath($tempFile, 'voucher.pdf');

        $mailer->send($message);

        return $this->render('voucher/show.html.twig', [
            'voucher' => $voucher
        ]);
    }

    #[Route('/voucher/{uuid}/download', name: 'voucher_download')]
    public function download(Voucher $voucher): Response
    {
        $tempFile = '/tmp/voucher_pdf/' . $voucher->getUuid() . '.pdf';

        if (!file_exists($tempFile)) {
            throw $this->createNotFoundException('PDF файл не найден или срок скачивания истек');
        }

        return new Response(
            file_get_contents($tempFile),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="voucher.pdf"'
            ]
        );
    }
}
