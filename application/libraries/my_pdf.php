<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once(APPPATH . 'libraries/tcpdf/tcpdf.php');
require_once(APPPATH . 'libraries/fpdi/src/autoload.php');

use setasign\Fpdi\Tcpdf\Fpdi;

class my_pdf extends Fpdi
{

    public function __construct()
    {
        parent::__construct();
    }

    public function merge_pdf($certificates, $pid)
    {
        $pdf = new Fpdi();
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        foreach ($certificates as $file) {
            if (file_exists($file->file)) {
                $pageCount = $pdf->setSourceFile($file->file);
                for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                    $tplIdx = $pdf->importPage($pageNo);
                    $pdf->AddPage();
                    $pdf->useTemplate($tplIdx, 0, 0, $pdf->getTemplateSize($tplIdx)['width'], $pdf->getTemplateSize($tplIdx)['height'], true);
                }
            } else {
                echo "No it doesnot " . "." . $file->file;
                exit;
            }
        }

        $outputFile = FCPATH . 'Assets/docs/merged/merged_doc_p' . $pid . '.pdf';
        $pdf->Output($outputFile, 'F');

        return true;
    }
}
