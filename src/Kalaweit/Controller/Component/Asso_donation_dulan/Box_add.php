<?php
namespace Kalaweit\Controller\Component\Asso_donation_dulan;

/**
*
*/
class Box_add

{
    public function render(){

        $bdd = new \Kalaweit\Manager\Connexion();
        $bdd = $bdd->getBdd();

        if( isset($_GET["cli_id"] ) ){ $cli_id = $_GET["cli_id"]; } else { $cli_id ='';}

        $payment_type = (new \Kalaweit\Manager\Asso_payment_type)->getAll($bdd);
        $cli = (new \Kalaweit\Manager\Member($bdd))->get_select();

        $donation_dulan_mnt = (new \Kalaweit\htmlElement\Form_group_input('donation_dulan_mnt','montant du don Dulan','','fa fa-euro'));
        $devise  = (new \Kalaweit\htmlElement\Form_group_select('ptyp_id',$payment_type,'','fa fa-internet-explorer',"ptyp_code"));
        $donator = (new \Kalaweit\htmlElement\Form_group_select('cli_id',$cli,$cli_id,'fa fa-user',"cli_identity" ));

        $submit  = '';
        $submit .=                      '<div class="form-group">';
        $submit .=                          '<!--<label style="color:white;" for="submit"> test</label>-->';
        $submit .=                          '<button id="submit" type="submit" class="form-control btn btn-primary"><i class="fa fa-save"></i></button>';
        $submit .=                      '</div>';


        $box_donation_dulan_content = [
            $donator->render(),
            $donation_dulan_mnt->render(),
            $devise->render(),
            $submit
        ];

        $col_md = [12,12,12,12];

        $box_donation_dulan = (new \Kalaweit\htmlElement\Box('Ajouter un don Dulan','box-primary',$box_donation_dulan_content,$col_md))->render();


        $box_last_donation_dulan = (new \Kalaweit\Controller\Component\Asso_donation_dulan\Table_last_donation_dulan)->render();

        $param = [
            "box_donation_dulan"=> $box_donation_dulan,
            "last_donation_dulan" => $box_last_donation_dulan

        ];

        return (new \Kalaweit\View\Asso_donation_dulan\Asso_donation_dulan)->render_add($param);
    }
}
