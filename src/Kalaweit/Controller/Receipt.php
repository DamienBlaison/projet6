<?php
/* classe permettant la génaration des recu au format PDF */

namespace Kalaweit\Controller;

class Receipt

{

    /* methode de generation des recu */

    function get($rec_id, $open)
    {

        /* initialisation de tableaux avec la traduction des elements en francais à afficher */

        $mois = array('','janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
        $jours = array('dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi');

        /* instanciation de la connexion à la Bdd */

        $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();

        /* Récupération des données à implémenter dans le reçu */

        $receipt_data = (new \Kalaweit\Manager\Receipt($bdd))->get($rec_id);

            $content = [

            "firstname" => $receipt_data["cli_firstname"],
            "lastname" => $receipt_data["cli_lastname"],
            "adress" =>    $receipt_data["cli_address1"].' '.$receipt_data["cli_address2"].' '.$receipt_data["cli_address3"],
            "zip" => $receipt_data["cli_cp"],
            "town" => $receipt_data["cli_town"],
            "tot_don_mnt" => $receipt_data["rec_mnt"],
            "year" => $receipt_data["rec_year"],
            "receipt_number" => $receipt_data["rec_number"],
            "country" =>$receipt_data["cnty_name"],
            "date" => $jours[date('w')].' '.date('j').' '.$mois[date('n')].' '.date('Y')

        ];

        return (new \Kalaweit\View\Receipt\Receipt($content))->render($open);

    }

    function add2(){

        $start = (new \Kalaweit\htmlElement\Form_group_input_date('start_date','jj/mm/aaaa','','fa fa-calendar','Date de début'))->render();
        $end   = (new \Kalaweit\htmlElement\Form_group_input_date('end_date','jj/mm/aaaa','','fa fa-calendar','Date de fin'))->render();

        $submit = (new \Kalaweit\htmlElement\Form_group_btn('submit','btn btn-primary col-md-12','receipt_btn','Générer les reçus'))->render();

        $card_nb_receipt = (new \Kalaweit\htmlElement\Box_info("100/100",'Reçu(s) généré(s)','fa fa-page',$p_color = 'bg-aqua'))->render();

        $content = [$start, $end, $submit,'</br>'];
        $content2 = [$card_nb_receipt];


        $box = (new \Kalaweit\htmlElement\Box('Génération des reçus','box-primary col-md-12',$content,[6,6,12,12]))->render();


        return (new \Kalaweit\View\Receipt\V_receipt([$box,$card_nb_receipt]))->render();
    }

    function add(){

        $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();
        $rec_id = ($receipt = new \Kalaweit\Manager\Receipt($bdd))->add($_GET["don_id"]);

        $visu_receipt = (new \Kalaweit\Controller\Receipt($bdd))->get($rec_id[0],"open");

    }

    function get_list()

    {
        $p_render = (new \Kalaweit\Controller\Component\Receipt\Table_list_receipt)->render();

        /* passage des param à la vue et instanciation de cette derniere */

        return (new \Kalaweit\View\Table\Table_filter)->render($p_render);

    }

    function generate(){
        $p_render = (new \Kalaweit\Controller\Component\Receipt\Generate)->render();
    }
}
