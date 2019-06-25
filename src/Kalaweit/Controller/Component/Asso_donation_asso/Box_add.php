<?php

/** classe permettant de creer un don et de l'injecter en bdd **/

namespace Kalaweit\Controller\Component\Asso_donation_asso;

class Box_add

{
    public function render(){

        /* instanciation connexion à la bdd */

        $bdd = new \Kalaweit\Manager\Connexion();
        $bdd = $bdd->getBdd();

        /* initialisation de la variable $cli_id */

        if( isset($_GET["cli_id"] ) ){ $cli_id = $_GET["cli_id"]; } else { $cli_id ='';}

        /* creation des composant html */

        $payment_type = (new \Kalaweit\Manager\Asso_payment_type)->getAll($bdd);
        $cli = (new \Kalaweit\Manager\Member($bdd))->get_select();
        $status_config = (new \Kalaweit\Manager\Status)->getAll($bdd);

        $donation_mnt = (new \Kalaweit\htmlElement\Form_group_input('donation_mnt','montant du don','','fa fa-euro'));
        $devise  = (new \Kalaweit\htmlElement\Form_group_select('ptyp_id',$payment_type,'','fa fa-internet-explorer',"ptyp_code"));
        $donator = (new \Kalaweit\htmlElement\Form_group_select('cli_id',$cli,$cli_id,'fa fa-user',"cli_identity" ));
        $status =  (new \Kalaweit\htmlElement\Form_group_select('don_status',$status_config,"",'fa fa-check',"config" ));

        $submit  = '';
        $submit .=                      '<div class="form-group">';
        $submit .=                          '<button id="submit" type="submit" class="form-control btn btn-primary"><i class="fa fa-save"></i></button>';
        $submit .=                      '</div>';

        /* tableau des différentes composants à passer à la vue */

        $box_donation_content = [
            $donator->render(),
            $donation_mnt->render(),
            $devise->render(),
            $status->render(),
            $submit
        ];

        /* mise en forme des éléments à passer */

        $col_md = [12,12,12,12,12];

        /* instanciation des composants BOX dans lequels les details des dons seront affichés */

        $box_donation = (new \Kalaweit\htmlElement\Box('Ajouter un don Association','box-primary',$box_donation_content,$col_md))->render();

        $box_last_donation = (new \Kalaweit\Controller\Component\Asso_donation_asso\Table_last_donation_asso)->render();

        /* passage des composants de la vue */

        $param = [
            "box_donation"=> $box_donation,
            "last_donation" => $box_last_donation

        ];

        return (new \Kalaweit\View\Asso_donation_asso\Asso_donation_asso)->render_add($param);
    }
}
