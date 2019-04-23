<?php
namespace Kalaweit\Controller\Component\Asso_donation_forest;

/**
 *
 */
class Asso_donation_forest
{

    public function update(){

        $bdd = new \Kalaweit\Manager\Connexion();
        $bdd = $bdd->getBdd();

    if(isset($_POST["cli_id"])) {

        (new \Kalaweit\Manager\Asso_donation_forest($bdd))->update();

    }

    $donation_forest = (new \Kalaweit\Manager\Asso_donation_forest($bdd))->get();

    $payment_type = (new \Kalaweit\Manager\Asso_payment_type)->getAll($bdd);
    $cli = (new \Kalaweit\Manager\Member($bdd))->get_select();

    $donation_forest_mnt = (new \Kalaweit\htmlElement\Form_group_input('donation_forest_mnt','montant du don',$donation_forest["don_mnt"],'fa fa-euro'));
    $devise  = (new \Kalaweit\htmlElement\Form_group_select('ptyp_id',$payment_type,$donation_forest["ptyp_id"],'fa fa-internet-explorer',"ptyp_code"));
    $donator = (new \Kalaweit\htmlElement\Form_group_select('cli_id',$cli,$donation_forest["cli_id"],'fa fa-user',"cli_identity" ));

    $button  = '';
    $button .=                      '<div class="form-group">';
    $button .=                          '<!--<label style="color:white;" for="submit"> test</label>-->';
    $button .=                          '<button id="submit" type="submit" class="form-control btn btn-primary"><i class="fa fa-save"></i></button>';
    $button .=                      '</div>';

    $box_donation_forest_content = [
        $donator->render(),
        $donation_forest_mnt->render(),
        $devise->render(),
        $button
    ];

    $col_md = [12,12,12,12];

    $box_donation_forest = (new \Kalaweit\htmlElement\Box('Modifier un don Foret','box-primary',$box_donation_forest_content,$col_md))->render();


    $param = [
        "box_donation_forest"=>$box_donation_forest,
    ];

    return $param;

    }

}
