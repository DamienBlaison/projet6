<?php
namespace Kalaweit\Controller\Component\Asso_cause;

/**
 *
 */
class Donation_current_year {

    function get(){

        $bdd = new \Kalaweit\Manager\Connexion();
        $bdd = $bdd->getBdd();

        $year = date("Y");
        $cau_id = $_GET["cau_id"];

        $donation_mnt =  (new \Kalaweit\Manager\Asso_donation($bdd))->get_year_sum_by_cause($year,$cau_id);

        return $donation_mnt;

    }
}

 ?>
