<?php
namespace Kalaweit\Controller\Component\Asso_adhesion;

/**
 *
 */
class Asso_adhesion
{

    public function update(){

        $bdd = new \Kalaweit\Manager\Connexion();
        $bdd = $bdd->getBdd();

    if(isset($_POST["cli_id"])) {

        (new \Kalaweit\Manager\Asso_adhesion($bdd))->update();

    }

    $adhesion = (new \Kalaweit\Manager\Asso_adhesion($bdd))->get();

    $payment_type = (new \Kalaweit\Manager\Asso_payment_type)->getAll($bdd);
    $cli = (new \Kalaweit\Manager\Member($bdd))->get_select();

    $adhesion_mnt = (new \Kalaweit\htmlElement\Form_group_input('adhesion_mnt','montant de l\'adhésion',$adhesion["adhesion_mnt"],'fa fa-euro'));
    $devise  = (new \Kalaweit\htmlElement\Form_group_select('ptyp_id',$payment_type,$adhesion["ptyp_id"],'fa fa-internet-explorer',"ptyp_code"));
    $donator = (new \Kalaweit\htmlElement\Form_group_select('cli_id',$cli,$adhesion["cli_id"],'fa fa-user',"cli_identity" ));

    $button  = '';
    $button .=                      '<div class="form-group">';
    $button .=                          '<!--<label style="color:white;" for="submit"> test</label>-->';
    $button .=                          '<button id="submit" type="submit" class="form-control btn btn-primary"><i class="fa fa-save"></i></button>';
    $button .=                      '</div>';

    $box_adhesion_content = [
        $donator->render(),
        $adhesion_mnt->render(),
        $devise->render(),
        $button
    ];

    $col_md = [12,12,12,12];

    $box_adhesion = (new \Kalaweit\htmlElement\Box('Modifier une adhésion','box-primary',$box_adhesion_content,$col_md))->render();


    $param = [
        "box_adhesion"=>$box_adhesion,
    ];

    return $param;

    }

}
