<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Autoload Composer
require_once APPPATH . '../vendor/autoload.php';

use Mpdf\Mpdf;

class Pdf_generator
{
    protected $mpdf;

    public function __construct($params = [])
    {
        $this->mpdf = new Mpdf($params);
    }

    public function generate($html, $filename = 'document.pdf', $output = 'I')
    {
        $this->mpdf->WriteHTML($html);
        return $this->mpdf->Output($filename, $output); // I: inline, D: download, F: file, S: string
    }

    public function get_instance()
    {
        return $this->mpdf;
    }
}
