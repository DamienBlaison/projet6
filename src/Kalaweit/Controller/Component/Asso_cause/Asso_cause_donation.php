<?php

namespace Kalaweit\Controller\Component\Asso_cause;

/**
 *
 */
class Asso_cause_donation
{
    function render(){

        $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();

        $p_nb_by_page = 5;
        $page = 1;

        $p_data = (new \Kalaweit\Manager\Asso_donation($bdd))->Asso_cause_donation($p_nb_by_page,$page);

        $p_name = "Les dons reçus";
        $p_id = "asso_cause_donation";
        $p_update = "www/Kalaweit/asso_donation/update?don_id=";
        $p_delete = "www/Kalaweit/asso_donation/delete?don_id=";
        $p_add = "www/Kalaweit/asso_donation/add";

        return (new \Kalaweit\htmlElement\Table($p_name,$p_data,$p_id,$p_update,$p_delete,$p_add,$p_nb_by_page))->render();

    }


}
