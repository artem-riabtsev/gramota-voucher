<?php

namespace App\Service;

use App\Entity\Voucher;
use Mpdf\Mpdf;
use Twig\Environment;


class PdfGenerator
{
    public function __construct(private Environment $twig) {}

    public function generate(Voucher $voucher): string
    {
        $mpdf = new Mpdf();

        $html = $this->twig->render('voucher/pdf.html.twig', [
            'voucher' => $voucher
        ]);

        $mpdf->WriteHTML($html);

        return $mpdf->Output('', 'S');
    }
}
