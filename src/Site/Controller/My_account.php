<?php
    namespace Site\Controller;

    /**
     *
     */
    class My_account

        {
        public function render(){



            $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();;

            $crm_countryM = new \Kalaweit\Manager\Crm_country();
            $client_categoryM  = new \Kalaweit\Manager\Crm_client_category();

            $member         = new \Kalaweit\Model\Member();
            $memberM        = new \Kalaweit\Manager\Member($bdd);

            if(isset($_POST)){$memberM->update($member,$_GET['cli_id']); }

            $desc_member    = $memberM->get($member,$_GET['cli_id']);

            $aside = (new \Site\View\Aside())->render();

            $info_member = [

            "firstname"  => (new \Site\htmlElement\Form_group_input('cli_lastname','text','Nom',$desc_member['cli_lastname'],'fa fa-user'))->render(),
            "lastname"   => (new \Site\htmlElement\Form_group_input('cli_firstname','text','Prénom', $desc_member['cli_firstname'],'fa fa-user'))->render(),
            "type"       => (new \Site\htmlElement\Form_group_select('clic_id', $client_categoryM->getAll($bdd),$desc_member['clic_id'],'fa fa-user',"clic_name"))->render(),
            "email"      => (new \Site\htmlElement\Form_group_input('clitd_3','Email','email', $desc_member['clitd_3'],'fa fa-at'))->render(),
            "phone1"     => (new \Site\htmlElement\Form_group_input('clitd_1','tel','Numéro de téléphone 1',$desc_member['clitd_1'],'fa fa-phone'))->render(),
            "phone2"     => (new \Site\htmlElement\Form_group_input('clitd_2','tel','Numéro de téléphone 2',$desc_member['clitd_2'],'fa fa-phone'))->render(),

            "address"    => (new \Site\htmlElement\Form_group_input('cli_address1','text','Adresse', $desc_member['cli_address1'],'fa fa-map-marker'))->render(),
            "address2"   => (new \Site\htmlElement\Form_group_input('cli_address2','text','Complément adresse', $desc_member['cli_address2'],'fa fa-map-marker'))->render(),
            "cp"         => (new \Site\htmlElement\Form_group_input('cli_cp','text','Code postal', $desc_member['cli_cp'],'fa fa-map'))->render(),
            "town"       => (new \Site\htmlElement\Form_group_input('cli_town','text','Ville',$desc_member['cli_town'],'fas fa-city'))->render(),
            "country"    => (new \Site\htmlElement\Form_group_select('cnty_id', $crm_countryM->getAll($bdd),$desc_member['cnty_id'],'fa fa-globe',"cnty_name"))->render(),
            "password"   => (new \Site\htmlElement\Form_group_input('clitd_6','password','Mot de passe', $desc_member['clitd_6'],'fa fa-lock',"required"))->render(),

            "submit"     => (new \Site\htmlElement\Form_group_btn('submit','btn-form','','Enregistrer'))->render()


        ];

        $info_donation = (new \Kalaweit\Manager\asso_donation($bdd))->get_donation_by_member_front();
        $info_donation_asso = (new \Kalaweit\Manager\asso_donation_asso($bdd))->get_donation_by_member_asso_front();
        $info_adhesion = (new \Kalaweit\Manager\asso_adhesion($bdd))->get_adhesion_by_member_front();
        $info_donation_dulan = (new \Kalaweit\Manager\asso_donation_dulan($bdd))->get_donation_dulan_by_member_front();
        $info_donation_forest = (new \Kalaweit\Manager\asso_donation_forest($bdd))->get_donation_forest_by_member_front();

        $print = 'www/Kalaweit/receipt/';

        $table = [

            "table_donation" => (new \Site\htmlElement\Table($info_donation,'donation_table',$print))->render(),
            "table_adhesion" => (new \Site\htmlElement\Table($info_adhesion,'adhesion_table',$print))->render(),
            "table_donation_asso" => (new \Site\htmlElement\Table($info_donation_asso,'donation_asso_table',$print))->render(),
            "table_donation_dulan" => (new \Site\htmlElement\Table($info_donation_dulan,'donation_dulan_table',$print))->render(),
            "table_donation_forest" => (new \Site\htmlElement\Table($info_donation_forest,'donation_forest_table',$print))->render()
        ];

        if(empty($info_donation["content"])){ $table["table_donation"] = "<p>Aucun don enregistré </p><br>"; }
        if(empty($info_donation_asso["content"])){ $table["table_donation_asso"] = "<p>Aucun don enregistré </p><br>"; }
        if(empty($info_adhesion["content"])){ $table["table_adhesion"] = "<p>Aucune adhésion enregistrée </p><br>"; }
        if(empty($info_donation_dulan["content"])){ $table["table_donation_dulan"] = "<p>Aucun don enregistré </p><br>"; }
        if(empty($info_donation_forest["content"])){ $table["table_donation_forest"] = "<p>Aucun don enregistré </p><br>"; }

        $content = [

            "param" =>$info_member,
            "table" =>$table,
            "aside" => $aside
        ];



        return (new \Site\View\My_account())->render($content);

        }
    }

 ?>
