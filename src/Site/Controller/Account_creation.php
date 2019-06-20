<?php
namespace Site\Controller;

/**
*
*/
class Account_creation

{
    public function render(){


        $config = \Kalaweit\Core\Config::getInstance();

        $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();;

        $member         = new \Kalaweit\Model\Member();
        $memberM        = new \Kalaweit\Manager\Member($bdd);


        if(isset($_POST["clitd_3"])){

            $check = $memberM->check_account();

            if($check == true){
                $memberM->add($member);
            }
        }

        $crm_countryM = new \Kalaweit\Manager\Crm_country();
        $client_categoryM  = new \Kalaweit\Manager\Crm_client_category();

        $aside = (new \Site\View\Aside())->render();

        $info_member = [

            "firstname"         => (new \Site\htmlElement\Form_group_input('cli_lastname','text','Nom','','fa fa-user',"required"))->render(),
            "lastname"          => (new \Site\htmlElement\Form_group_input('cli_firstname','text','Prénom', '','fa fa-user',"required"))->render(),
            "type"              => (new \Site\htmlElement\Form_group_select('clic_id', $client_categoryM->getAll($bdd),'','fa fa-user',"clic_name"))->render(),
            "email"             => (new \Site\htmlElement\Form_group_input('clitd_3','email','Email', '','fa fa-at',"required pattern='Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/'"))->render(),
            "password"          => (new \Site\htmlElement\Form_group_input('clitd_6','password','Mot de passe', '','fa fa-lock',"required"))->render(),

            "phone1"     => (new \Site\htmlElement\Form_group_input('clitd_1','tel','Numéro de téléphone 1','','fa fa-phone',"required pattern='^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}'"))->render(),
            "phone2"     => (new \Site\htmlElement\Form_group_input('clitd_2','tel','Numéro de téléphone 2','','fa fa-phone',"pattern='^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}'"))->render(),

            "address"    => (new \Site\htmlElement\Form_group_input('cli_address1','text','Adresse', '','fa fa-map-marker',"required"))->render(),
            "address2"   => (new \Site\htmlElement\Form_group_input('cli_address2','text','Complément adresse', '','fa fa-map-marker'))->render(),
            "cp"         => (new \Site\htmlElement\Form_group_input('cli_cp','text','Code postal', '','fa fa-map',"required"))->render(),
            "town"       => (new \Site\htmlElement\Form_group_input('cli_town','text','Ville','','fas fa-city','required '))->render(),
            "country"    => (new \Site\htmlElement\Form_group_select('cnty_id',$crm_countryM->getAll($bdd),'','fa fa-globe',"cnty_name"))->render(),

            "submit"     => (new \Site\htmlElement\Form_group_btn('submit','btn-form','','Enregistrer'))->render()


        ];

        $content = [

            "param" =>$info_member,
            "aside" => $aside
        ];



        return (new \Site\View\Account_creation())->render($content);

    }
}

?>
