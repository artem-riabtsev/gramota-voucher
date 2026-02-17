<?php

// namespace App\Service;

// use App\Entity\Voucher;
// use Dompdf\Dompdf;
// use Twig\Environment;

// class PdfGenerator
// {
//     public function __construct(private Environment $twig) {}

//     public function generate(Voucher $voucher): string
//     {
//         $dompdf = new Dompdf();

//         $html = $this->twig->render('voucher/pdf.html.twig', [
//             'voucher' => $voucher
//         ]);

//         $dompdf->loadHtml($html);
//         $dompdf->render();

//         return $dompdf->output();
//     }
// }

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
