<?php

/** classe permettant de mettre à jour un don effectué **/

namespace Kalaweit\Controller\Component\Asso_donation;

class Asso_donation
{
    public function update(){

        /* instanciation connexion à la bdd */

        $bdd = new \Kalaweit\Manager\Connexion();
        $bdd = $bdd->getBdd();

        /* vérification des informations dans la super variable POST pour MAJ des données en BDD*/

        if(isset($_POST["cli_id"])) {

            (new \Kalaweit\Manager\Asso_donation($bdd))->update();

        }

        /* affichage des données , renvoi un arrray */

        $donation = (new \Kalaweit\Manager\Asso_donation($bdd))->get();

        /* creation des composant html */

        $payment_type = (new \Kalaweit\Manager\Asso_payment_type)->getAll($bdd);
        $cli = (new \Kalaweit\Manager\Member($bdd))->get_select();
        $cau = (new \Kalaweit\Manager\Asso_cause($bdd))->get_select();
        $status_config = (new \Kalaweit\Manager\Status)->getAll($bdd);

        $don_mnt = (new \Kalaweit\htmlElement\Form_group_input('don_mnt','montant du don',$donation["don_mnt"],'fa fa-euro'));
        $devise  = (new \Kalaweit\htmlElement\Form_group_select('ptyp_id',$payment_type,$donation["ptyp_id"],'fa fa-internet-explorer',"ptyp_code"));
        $donator = (new \Kalaweit\htmlElement\Form_group_select('cli_id',$cli,$donation["cli_id"],'fa fa-user',"cli_identity" ));
        $cause     = (new \Kalaweit\htmlElement\Form_group_select('cau_id',$cau,$donation["cau_id"],'fa fa-paw',"cau_name" ));
        $status =  (new \Kalaweit\htmlElement\Form_group_select('don_status',$status_config,$donation["don_status"],'fa fa-check',"config" ));


        $button  = '';
        $button .=                      '<div class="form-group">';
        $button .=                          '<!--<label style="color:white;" for="submit"> test</label>-->';
        $button .=                          '<button id="submit" type="submit" class="form-control btn btn-primary"><i class="fa fa-save"></i></button>';
        $button .=                      '</div>';

        /* tableau des différentes composants à passer à la vue */

        $box_donation_content = [
            $donator->render(),
            $cause->render(),
            $don_mnt->render(),
            $devise->render(),
            $status->render(),
            $button
        ];

        /* mise en forme des éléments à passer */

        $col_md = [12,12,12,12,12,12];

        /* instanciation du composant BOX dans lequel le detail des dons sera affiché */

        $box_donation = (new \Kalaweit\htmlElement\Box('Modifier un don','box-primary',$box_donation_content,$col_md))->render();

        /* passage des composants de la vue */

        $param = [
            "box_donation"=>$box_donation,
        ];

        return $param;

    }

}
