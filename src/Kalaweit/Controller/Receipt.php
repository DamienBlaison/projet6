<?php
/* classe permettant la génaration des recu au format PDF */

namespace Kalaweit\Controller;

class Receipt

{
    /* methode de generation des recu */

    function get()
    {

        /* initialisation de tableaux avec la traduction des elements en francais à afficher */

        $mois = array('','janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
        $jours = array('dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi');

        /* instanciation de la connexion à la Bdd */

        $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();

        /* Récupération des données à implémenter dans le reçu */

        $receipt_data = (new Kalaweit\Manager\Receipt())->get();

            $content = [

            "firstname" => $receipt_data["cli_firstname"],
            "lastname" => $receipt_data["cli_lastname"],
            "adress" =>    $receipt_data["cli_address1"].' '.$receipt_data["cli_address2"].' '.$receipt_data["cli_address3"],
            "zip" => $receipt_data["cli_cp"],
            "town" => $receipt_data["cli_town"],
            "tot_don_mnt" => $receipt_data["rec_mnt"],
            "year" => $receipt_data["rec_year"],
            "receipt_number" => $receipt_data["rec_num"],
            "country" =>$receipt_data["cnty_name"],
            "date" => $jours[date('w')].' '.date('j').' '.$mois[date('n')].' '.date('Y')

        ];

        return (new \Kalaweit\View\Receipt\Receipt($content))->render();

    }
}
