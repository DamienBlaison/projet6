<?php
namespace Kalaweit\Export;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
*
*/
class Export_Excel
{

    function render($p_tab)

    {

        $name = $_GET["export_name"];
        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->fromArray($p_tab["head"],NULL,'A1');
        $spreadsheet->getActiveSheet()->fromArray($p_tab["content"],NULL,'A2');

        $writer = new Xlsx($spreadsheet);
        $writer->save($name.'.xlsx');

    }
}
