<?php
namespace Kalaweit\Controller\Component\Asso_adhesion;

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
        $status = (new \Kalaweit\Manager\Status())->getAll();

        $adhesion_mnt = (new \Kalaweit\htmlElement\Form_group_input('adhesion_mnt','montant de l\'adhésion','','fa fa-euro'));
        $devise  = (new \Kalaweit\htmlElement\Form_group_select('ptyp_id',$payment_type,'','fa fa-internet-explorer',"ptyp_code"));
        $donator = (new \Kalaweit\htmlElement\Form_group_select('cli_id',$cli,$cli_id,'fa fa-user',"cli_identity" ));
        $status = (new \Kalaweit\htmlElement\Form_group_select('adhesion_status',$status,'','fa fa-user',"config" ));

        $submit  = '';
        $submit .=                      '<div class="form-group">';
        $submit .=                          '<!--<label style="color:white;" for="submit"> test</label>-->';
        $submit .=                          '<button id="submit" type="submit" class="form-control btn btn-primary"><i class="fa fa-save"></i></button>';
        $submit .=                      '</div>';


        $box_adhesion_content = [
            $donator->render(),
            $adhesion_mnt->render(),
            $devise->render(),
            $status->render(),
            $submit
        ];

        $col_md = [12,12,12,12,12];

        $box_adhesion = (new \Kalaweit\htmlElement\Box('Ajouter une adhésion','box-primary',$box_adhesion_content,$col_md))->render();


        $box_last_adhesion = (new \Kalaweit\Controller\Component\Asso_adhesion\Table_last_adhesion)->render();

        $param = [
            "box_adhesion"=> $box_adhesion,
            "last_adhesion" => $box_last_adhesion

        ];

        return (new \Kalaweit\View\Asso_adhesion\Asso_adhesion)->render_add($param);
    }
}
