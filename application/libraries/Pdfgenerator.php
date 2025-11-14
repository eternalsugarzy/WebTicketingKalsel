<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Memanggil autoloader Dompdf
require_once APPPATH . 'third_party/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdfgenerator {

    public function generate($html, $filename='', $stream=TRUE, $paper = 'A4', $orientation = "portrait")
    {
        // Atur opsi untuk Dompdf
        $options = new Options();
        // [PENTING] Aktifkan 'isRemoteEnabled' agar Dompdf bisa memuat
        // gambar dari URL (misal: logo di kop surat)
        $options->set('isRemoteEnabled', TRUE);
        
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        
        if ($stream) {
            // "Stream" (tampilkan) di browser
            // 'Attachment' => 0 artinya tampilkan, bukan download
            $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        } else {
            // "Save" ke server (jika diperlukan)
            return $dompdf->output();
        }
    }
}