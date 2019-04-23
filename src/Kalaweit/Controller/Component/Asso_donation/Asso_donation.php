<?php
namespace Kalaweit\Controller\Component\Asso_donation;

/**
 *
 */
class Asso_donation
{
    public function update2(){


    $bdd = new \Kalaweit\Manager\Connexion();
    $bdd = $bdd->getBdd();

    if( isset($_GET["cli_id"] ) ){ $cli_id = $_GET["cli_id"]; } else { $cli_id ='';}

    //$clic_id            = new \Kalaweit\htmlElement\Form_group_select('clic_id',$crm_client_categoryM->getAll($bddM),$desc_member['clic_id'],'fa fa-user',"clic_name");

    $payment_type = (new \Kalaweit\Manager\Asso_payment_type)->getAll($bdd);
    $cli = (new \Kalaweit\Manager\Member($bdd))->get_select();
    $cau = (new \Kalaweit\Manager\Asso_cause($bdd))->get_select();

    $don_mnt = (new \Kalaweit\htmlElement\Form_group_input('don_mnt','montant du don',"",'fa fa-euro'));
    $devise  = (new \Kalaweit\htmlElement\Form_group_select('ptyp_id',$payment_type,"",'fa fa-internet-explorer',"ptyp_code"));
    $donator = (new \Kalaweit\htmlElement\Form_group_select('cli_id',$cli,$cli_id,'fa fa-user',"cli_identity" ));
    $cause     = (new \Kalaweit\htmlElement\Form_group_select('cau_id',$cau,"",'fa fa-paw',"cau_name" ));


    $button  = '';
    $button .=                      '<div class="form-group col-md-12">';
    $button .=                          '<!--<label style="color:white;" for="submit"> test</label>-->';
    $button .=                          '<button id="submit" type="submit" class="form-control btn btn-primary"><i class="fa fa-plus"></i></button>';
    $button .=                      '</div>';

    $box_donation_content = [
        $donator->render(),
        $cause->render(),
        $don_mnt->render(),
        $devise->render(),
        $button
    ];

    $col_md = [3,3,2,3,1];

    $box_donation = (new \Kalaweit\htmlElement\Box('Modifier un Don','box-primary',$box_donation_content,$col_md))->render();


    $param = [
        "box_donation"=>$box_donation,
    ];

    return $param;

    }

    public function update(){

        $bdd = new \Kalaweit\Manager\Connexion();
        $bdd = $bdd->getBdd();

    if(isset($_POST["cli_id"])) {

        (new \Kalaweit\Manager\Asso_donation($bdd))->update();

    }

    $donation = (new \Kalaweit\Manager\Asso_donation($bdd))->get();

    $payment_type = (new \Kalaweit\Manager\Asso_payment_type)->getAll($bdd);
    $cli = (new \Kalaweit\Manager\Member($bdd))->get_select();
    $cau = (new \Kalaweit\Manager\Asso_cause($bdd))->get_select();

    $don_mnt = (new \Kalaweit\htmlElement\Form_group_input('don_mnt','montant du don',$donation["don_mnt"],'fa fa-euro'));
    $devise  = (new \Kalaweit\htmlElement\Form_group_select('ptyp_id',$payment_type,$donation["ptyp_id"],'fa fa-internet-explorer',"ptyp_code"));
    $donator = (new \Kalaweit\htmlElement\Form_group_select('cli_id',$cli,$donation["cli_id"],'fa fa-user',"cli_identity" ));
    $cause     = (new \Kalaweit\htmlElement\Form_group_select('cau_id',$cau,"",'fa fa-paw',"cau_name" ));


    $button  = '';
    $button .=                      '<div class="form-group">';
    $button .=                          '<!--<label style="color:white;" for="submit"> test</label>-->';
    $button .=                          '<button id="submit" type="submit" class="form-control btn btn-primary"><i class="fa fa-save"></i></button>';
    $button .=                      '</div>';

    $box_donation_content = [
        $donator->render(),
        $cause->render(),
        $don_mnt->render(),
        $devise->render(),
        $button
    ];

    $col_md = [12,12,12,12,12];

    $box_donation = (new \Kalaweit\htmlElement\Box('Modifier un don','box-primary',$box_donation_content,$col_md))->render();


    $param = [
        "box_donation"=>$box_donation,
    ];

    return $param;

    }

    //public function render_update(){

    //$bdd = new \Kalaweit\Manager\Connexion();
    //$bdd = $bdd->getBdd();

    //if(isset($_POST["cau_id"])){

    //    (new \Kalaweit\Manager\Asso_donation($bdd))->update();

    //}



    //$donation = (new \Kalaweit\Manager\Asso_donation($bdd))->get();

    //$payment_type = (new \Kalaweit\Manager\Asso_payment_type)->getAll($bdd);
    //$cli = (new \Kalaweit\Manager\Member($bdd))->get_select();
    //$cau = (new \Kalaweit\MAnager\Asso_cause($bdd))->get_select();

    //$don_mnt = (new \Kalaweit\htmlElement\Form_group_input('don_mnt','montant du don',$donation["don_mnt"],'fa fa-euro'));
    //$devise  = (new \Kalaweit\htmlElement\Form_group_select('ptyp_id',$payment_type,$donation["ptyp_id"],'fa fa-internet-explorer',"ptyp_code"));
    //$donator = (new \Kalaweit\htmlElement\Form_group_select('cli_id',$cli,$donation["cli_id"],'fa fa-user',"cli_identity" ));
    //$cause     = (new \Kalaweit\htmlElement\Form_group_select('cau_id',$cau,$donation["cau_id"],'fa fa-paw',"cau_name" ));


    //$button  = '';
    //$button .=                      '<div class="form-group col-md-12">';
    //$button .=                          '<!--<label style="color:white;" for="submit"> test</label>-->';
    //$button .=                          '<button id="submit" type="submit" class="form-control btn btn-primary"><i class="fa fa-save"></i></button>';
    //$button .=                      '</div>';

    //$box_donation_content = [
    //    $donator->render(),
    //    $cause->render(),
    //    $don_mnt->render(),
    //    $devise->render(),
    //    $button
    //];

    //$col_md = [3,3,2,3,1];

    //$box_donation = (new \Kalaweit\htmlElement\Box('Modifier un Don','box-primary',$box_donation_content,$col_md))->render();


    //$param = [
    //    "box_donation"=>$box_donation,
    //];

    //return $param;

    //}

}
