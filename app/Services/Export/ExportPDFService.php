<?php

namespace App\Services\Export;

use Dompdf\Dompdf;
use Dompdf\Options;

class ExportPDFService
{
    public function execute(string $html, string $filename = 'document.pdf', string $paper = 'A4', string $orientation = 'portrait')
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true); // Mengizinkan load CSS/Gambar dari URL

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();

        // Stream langsung mendownload file ke browser
        $dompdf->stream($filename, ["Attachment" => true]);
        exit();
    }
}
