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

    public function generate($html, $filename = '', $output = 'I', $config = [])
    {
        // Default config kalau tidak dikirim
        $defaultConfig = [
            'format' => 'A4-L', // Landscape A4
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 0,
            'margin_bottom' => 0,
        ];

        // Merge config yang dikirim user
        $config = array_merge($defaultConfig, $config);

        // Buat instance mPDF dengan konfigurasi
        $mpdf = new Mpdf([
            'format' => $config['format'],
            'margin_left' => $config['margin_left'],
            'margin_right' => $config['margin_right'],
            'margin_top' => $config['margin_top'],
            'margin_bottom' => $config['margin_bottom'],
        ]);

        $mpdf->WriteHTML($html);

        // Output PDF sesuai tipe
        $mpdf->Output($filename, $output);
    }

    public function get_instance()
    {
        return $this->mpdf;
    }
}
