<?php
/* classe permettant la génaration des recus fiscaux annuel au format PDF */

namespace Kalaweit\Controller;

class Receipt_annual

{

    function add(){

        $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();

        $receipt_resume = (new \Kalaweit\Manager\Receipt($bdd))->resume_donations_year_by_member($_GET["cli_id"]);

        (new \Kalaweit\Manager\Receipt_annual($bdd))->add();

        //return (new \Kalaweit\View\Receipt\Receipt_annual($content))->render();



    }


}
