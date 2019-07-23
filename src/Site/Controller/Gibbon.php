<?php
namespace Site\Controller;
/**
 *
 */
class Gibbon
{
    function render(){

        $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();

        $aside = (new \Site\View\Aside())->render();

        if(isset($_GET["cau_id"])){

            $info_gibbon = (new \Kalaweit\Manager\Asso_cause($bdd))->get($_GET["cau_id"]);

        } else {

            header("Location:/www/home");
        };

        $list_donator = (new \Kalaweit\Manager\Asso_cause($bdd))->get_donator();

        $list_donator_string = '';

        foreach ($list_donator as $key => $value) {

            $list_donator_string .= $value["cli_lastname"].' '.$value["cli_firstname"].' - ';
            // code...
        }

        $list_donator_string = substr($list_donator_string,0,-3);

        $mnt_dispo = (new \Kalaweit\Manager\Asso_donation($bdd))->get_mnt_donation_current_year();

        $content = [
            "aside" => $aside,
            "info_gibbon" =>$info_gibbon,
            "species" => $ac_specieM = (new \Kalaweit\Manager\Specie)->getAll(),
            "donator" => $list_donator_string,
            "donation" => $mnt_dispo
        ];



        return (new \Site\View\Gibbon())->render($content);

    }

}

 ?>
