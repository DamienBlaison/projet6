<?php
namespace Kalaweit\Controller;

class Dashboard
{

    function get(){

        $bdd = new \Kalaweit\Manager\Connexion();
        $bdd = $bdd->getBdd();

        $year = date('Y');

        $card4_data = (new \Kalaweit\Manager\Asso_donation($bdd))->get_year_sum($year);
        $card5_data = (new \Kalaweit\Manager\Asso_donation_dulan($bdd))->get_year_sum($year);
        $card6_data = (new \Kalaweit\Manager\Asso_donation_forest($bdd))->get_year_sum($year);

        $card7_data = (new \Kalaweit\Manager\Asso_donation_asso($bdd))->get_year_sum($year);
        $card8_data = (new \Kalaweit\Manager\Asso_adhesion($bdd))->get_year_sum($year);

        $card4 = (new \Kalaweit\htmlElement\Box_info($card4_data[0].' €', 'Ajouter un nouveau don', 'fa fa-paw'))->render();
        $card5 = (new \Kalaweit\htmlElement\Box_info($card5_data[0].' €', 'Ajouter un nouveau Don Dulan', 'fa fa-map','bg-yellow'))->render();
        $card6 = (new \Kalaweit\htmlElement\Box_info($card6_data[0].' €', 'Ajouter un nouveau Don Foret', 'fa fa-tree','bg-green'))->render();

        $card7 = (new \Kalaweit\htmlElement\Box_info($card7_data[0].' €', 'Ajouter un nouveau Association', 'fa fa-home','bg-purple'))->render();
        $card8 = (new \Kalaweit\htmlElement\Box_info($card8_data[0].' €', 'Ajouter un nouvelle adhésion', 'fa fa-home','bg-red'))->render();

        $p_render =[


            "card7" => $card7,
            "card8" => $card8,
            "card4" => $card4,
            "card5" => $card5,
            "card6" => $card6,

        ];



        return (new \Kalaweit\View\Dashboard\Dashboard)->render($p_render);

    }
}
