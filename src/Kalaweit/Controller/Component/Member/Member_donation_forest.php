<?php

namespace Kalaweit\Controller\Component\Member;

/**
 *
 */
class Member_donation_forest
{

    function render(){

        $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();

        $p_nb_by_page = 5;
        $page = 1;

        $p_data = (new \Kalaweit\Manager\Asso_donation_forest($bdd))->get_donation_forest_by_member($p_nb_by_page,$page);

        $p_name = "Les dons Forets";
        $p_id = "donation_forest_by_member";
        $p_update = "www/Kalaweit/asso_donation_forest/update?don_id=";
        $p_delete = "www/Kalaweit/asso_donation_forest/delete?don_id=";
        $p_add = "www/Kalaweit/asso_donation_forest/add?cli_id=".$_GET["cli_id"];

        return (new \Kalaweit\htmlElement\Table($p_name,$p_data,$p_id,$p_update,$p_delete,$p_add,$p_nb_by_page))->render();



    }
}
