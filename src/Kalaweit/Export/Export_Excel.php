<?php
/* classe  permmettant la création de fichier excel */
namespace Kalaweit\Export;

/* import des traits du package */

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Export_Excel
{

    /* methode permettant de renvoyer un tableau excel */

    function render($p_tab)

    {
        /* initialisation du nom du fichier a créer */

        $name = $_GET["export_name"];

        /* instanciation de l'objet Spreadsheet */

        $spreadsheet = new Spreadsheet();

        /* application de la méthode getActiveSheet()->fromArray permmettant de remplir le fichier excel à partir d'un tableau */

        /*creation de l'entete du tableau */

        $spreadsheet->getActiveSheet()->fromArray($p_tab["head"],NULL,'A1');

        /* cretaion du corps du tableau */

        $spreadsheet->getActiveSheet()->fromArray($p_tab["content"],NULL,'A2');

        /* instanciation d'un objet XLSX en parametre */

        $writer = new Xlsx($spreadsheet);

        /* ecriture du fichier */
        
        $writer->save($name.'.xlsx');

    }
}
