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

        $content = (new \Kalaweit\Manager\Asso_donation($bdd))->get_donation_by_cause($p_nb_by_page);
        $p_name = "table_donator";
        $p_id = "table_donator";
        $p_link = '';
        $p_update = "";
        $p_delete = "";
        $p_add = "";


        $p_data = $content;



        return (new \Kalaweit\htmlElement\Table($p_name,$p_data,$p_id,$p_link,$p_update,$p_delete,$p_add,$p_nb_by_page))->render();

    }


}
