<?php

namespace Kalaweit\Controller\Component\Member;

/**
 *
 */
class Member_info
{

    function render(){

        $config = \Kalaweit\Core\Config::getInstance();

        $bddM = new \Kalaweit\Manager\Connexion();
        $bddM = $bddM->getBdd();

        $crm_countryM = new \Kalaweit\Manager\Crm_country();
        $cli_langM  = new \Kalaweit\Manager\Cli_lang();
        $crm_client_categoryM  = new \Kalaweit\Manager\Crm_client_category();

        $member         = new \Kalaweit\Model\Member();
        $memberM        = new \Kalaweit\Manager\Member($bddM);

        $url = explode('/',$_SERVER['REQUEST_URI']);

        if ($url[4]=='add'){
                    $desc_member    = $memberM->add($member);
        } else {
                    $desc_member    = $memberM->get($member,$_GET['cli_id']);
        };

        $cli_lastname       = new \Kalaweit\htmlElement\Form_group_input('cli_lastname','Nom',$desc_member['cli_lastname'],'fa fa-user');
        $cli_firstname      = new \Kalaweit\htmlElement\Form_group_input('cli_firstname','Prénom', $desc_member['cli_firstname'],'fa fa-user');
        $box_info_member    = new \Kalaweit\htmlElement\Box('Informations membres','box-primary',[$cli_lastname->render(),$cli_firstname->render()],[12,12]);

        $clic_id            = new \Kalaweit\htmlElement\Form_group_select('clic_id',$crm_client_categoryM->getAll($bddM),$desc_member['clic_id'],'fa fa-user',"clic_name");

        $box_info_donator   = new \Kalaweit\htmlElement\Box('Type de donateur','box-primary',[$clic_id->render()],[12]);

        $cli_lang           = new \Kalaweit\htmlElement\Form_group_select('cli_lang',$cli_langM->getAll($bddM),$desc_member['cli_lang'],'fa fa-user',"config");
        $box_other_info     = new \Kalaweit\htmlElement\Box('Autres informations','box-primary',[$cli_lang->render()],[12]);

        $cli_address1       = new \Kalaweit\htmlElement\Form_group_input('cli_address1','Adresse', $desc_member['cli_address1'],'fa fa-map-marker');
        $cli_address2       = new \Kalaweit\htmlElement\Form_group_input('cli_address2','Complément adressse 1', $desc_member['cli_address2'],'fa fa-map-marker');
        $cli_address3       = new \Kalaweit\htmlElement\Form_group_input('cli_address3','Complément adressse 2', $desc_member['cli_address3'],'fa fa-map-marker');
        $cli_cp             = new \Kalaweit\htmlElement\Form_group_input('cli_cp','Code postal', $desc_member['cli_cp'],'fa fa-map-marker');
        $cli_town           = new \Kalaweit\htmlElement\Form_group_input('cli_town','Ville', $desc_member['cli_town'],'fa fa-map-marker');
        $cnty_id            = new \Kalaweit\htmlElement\Form_group_select('cnty_id', $crm_countryM->getAll($bddM),$desc_member['cnty_id'],'fa fa-map-marker',"cnty_name");
        $cli_tel1           = new \Kalaweit\htmlElement\Form_group_input('clitd_1',"Numéro de téléphone 1",$desc_member['clitd_1'],'fa fa-phone');
        $cli_tel2           = new \Kalaweit\htmlElement\Form_group_input('clitd_2','Numéro de téléphone 2', $desc_member['clitd_2'],'fa fa-phone');
        $cli_mail1          = new \Kalaweit\htmlElement\Form_group_input('clitd_3','Email 1', $desc_member['clitd_3'],'fa fa-at');

        $box_cli_data_content = [

            $cli_address1->render(),
            $cli_address2->render(),
            $cli_address3->render(),
            $cli_cp->render(),
            $cli_town->render(),
            $cnty_id->render(),
            $cli_tel1->render(),
            $cli_tel2->render(),
            $cli_mail1->render(),
        ];

        $box_cli_data           = new \Kalaweit\htmlElement\Box('Coordonnées','box-primary',$box_cli_data_content,[12,12,12,4,8,12,6,6,12]);

        $cli_comment            = new \Kalaweit\htmlElement\Form_group_textarea('clitd_4',$desc_member['clitd_4']);

        $box_cli_comment        = new \Kalaweit\htmlElement\Box('Commentaire','box-primary',[$cli_comment->render()],[12]);

        $card1_data = (new \Kalaweit\Manager\Asso_donation($bddM))->get_donation_by_member_card();
        $card2_data = (new \Kalaweit\Manager\Asso_donation_dulan($bddM))->get_donation_dulan_by_member_card();
        $card3_data = (new \Kalaweit\Manager\Asso_donation_forest($bddM))->get_donation_forest_by_member_card();




        $card1 = (new \Kalaweit\htmlElement\Box_info($card1_data[0]. ' €', 'Dons Animaux', 'fa fa-paw'))->render();
        $card2 = (new \Kalaweit\htmlElement\Box_info($card2_data[0]. ' €', 'Dons Dulan', 'fa fa-map','bg-yellow'))->render();
        $card3 = (new \Kalaweit\htmlElement\Box_info($card3_data[0]. ' €', 'Dons Foret', 'fa fa-tree','bg-green'))->render();

        $param = [

            "box_info_member"   => $box_info_member,
            "box_info_donator"  => $box_info_donator,
            "box_other_info"    => $box_other_info,
            "box_cli_data"      => $box_cli_data,
            "box_cli_comment"   => $box_cli_comment,
            "card1"             => $card1,
            "card2"             => $card2,
            "card3"             => $card3,


        ];

        return (new \Kalaweit\View\Member\Member\Member_info)->render($param);
    }
}

 ?>
