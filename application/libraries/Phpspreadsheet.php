<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Autoload PhpSpreadsheet classes secara manual
require_once(APPPATH . 'third_party/PhpSpreadsheet/src/Bootstrap.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet as OfficeSpreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Spreadsheet {
    public function load($path) {
        return IOFactory::load($path);
    }

    public function newSheet() {
        return new OfficeSpreadsheet();
    }

    public function writer($spreadsheet, $type = 'Xlsx') {
        return IOFactory::createWriter($spreadsheet, $type);
    }
}
