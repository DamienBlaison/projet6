<?php
/* classe permettant de recuperer le contenu des rapport annuels */
namespace Kalaweit\Controller;

class Annual_report
{

    function get_list(){

        ////////////////////////////////////////////////////////////

        //         recuperation des param de la liste             //

        ////////////////////////////////////////////////////////////

        $bdd = (new \Kalaweit\Manager\Connexion)->getBdd();

        if(isset($_GET['y'])){$year = $_GET['y']; } else { $year = date('Y');}

        $p_name         = 'y';
        $p_option       = (new \Kalaweit\Manager\Year)->getAll() ;
        $p_selected     = $_GET['y'];
        $p_fontawesome  ='fa fa-calendar';
        $p_return       ='config';

        ////////////////////////////////////////////////////////////

        //         recuperation donnees des cards            //

        ////////////////////////////////////////////////////////////

        $card1_data = (new \Kalaweit\Manager\Asso_donation($bdd))->get_year_count($year);
        $card2_data = (new \Kalaweit\Manager\Asso_donation_dulan($bdd))->get_year_count($year);
        $card3_data = (new \Kalaweit\Manager\Asso_donation_forest($bdd))->get_year_count($year);

        $card4_data = (new \Kalaweit\Manager\Asso_donation($bdd))->get_year_sum($year);
        $card5_data = (new \Kalaweit\Manager\Asso_donation_dulan($bdd))->get_year_sum($year);
        $card6_data = (new \Kalaweit\Manager\Asso_donation_forest($bdd))->get_year_sum($year);

        ////////////////////////////////////////////////////////////

        //         recuperation donnees des graphiques            //

        ////////////////////////////////////////////////////////////

        $data1 = (new \Kalaweit\Manager\Asso_donation($bdd))->get_chart_data_count($year);
        $data2 = (new \Kalaweit\Manager\Asso_donation_dulan($bdd))->get_chart_data_count($year);
        $data3 = (new \Kalaweit\Manager\Asso_donation_forest($bdd))->get_chart_data_count($year);

        $data4 = (new \Kalaweit\Manager\Asso_donation($bdd))->get_chart_data_sum($year);
        $data5 = (new \Kalaweit\Manager\Asso_donation_dulan($bdd))->get_chart_data_sum($year);
        $data6 = (new \Kalaweit\Manager\Asso_donation_forest($bdd))->get_chart_data_sum($year);

        ////////////////////////////////////////////////////////////

        //         recuperation donnees des tables count          //

        ////////////////////////////////////////////////////////////

        $data_resume1 = (new \Kalaweit\Manager\Asso_donation($bdd))->get_resume_data_count($year);
        array_unshift($data_resume1,"Animaux");

        $data_resume2= (new \Kalaweit\Manager\Asso_donation_dulan($bdd))->get_resume_data_count($year);
        array_unshift($data_resume2,"Dulan");

        $data_resume3= (new \Kalaweit\Manager\Asso_donation_forest($bdd))->get_resume_data_count($year);
        array_unshift($data_resume3,"Forêt");

        ////////////////////////////////////////////////////////////

        //         recuperation donnees des tables Sum            //

        ////////////////////////////////////////////////////////////

        $data_resume4 = (new \Kalaweit\Manager\Asso_donation($bdd))->get_resume_data_sum($year);
        array_unshift($data_resume4,"Animaux");

        $data_resume5= (new \Kalaweit\Manager\Asso_donation_dulan($bdd))->get_resume_data_sum($year);
        array_unshift($data_resume5,"Dulan");

        $data_resume6= (new \Kalaweit\Manager\Asso_donation_forest($bdd))->get_resume_data_sum($year);
        array_unshift($data_resume6,"Forêt");

        ////////////////////////////////////////////////////////////

        //         Instanciation des vues des graphiques          //

        ////////////////////////////////////////////////////////////

        $card1 = (new \Kalaweit\htmlElement\Box_info($card1_data[0], 'Dons Animaux', 'fa fa-paw'))->render();
        $card2 = (new \Kalaweit\htmlElement\Box_info($card2_data[0], 'Dons Dulan', 'fa fa-map','bg-yellow'))->render();
        $card3 = (new \Kalaweit\htmlElement\Box_info($card3_data[0], 'Dons Foret', 'fa fa-tree','bg-green'))->render();
        $card4 = (new \Kalaweit\htmlElement\Box_info($card4_data[0].' €', 'Dons animaux', 'fa fa-paw'))->render();
        $card5 = (new \Kalaweit\htmlElement\Box_info($card5_data[0].' €', 'Dons Dulan', 'fa fa-map','bg-yellow'))->render();
        $card6 = (new \Kalaweit\htmlElement\Box_info($card6_data[0].' €', 'Dons Foret', 'fa fa-tree','bg-green'))->render();

        $chart1 = (new \Kalaweit\View\Annual_report\Component\Donation_one_shot)->render('donation_one_shot_animal_count','Nombre de dons animaux',$data1);
        $chart2 = (new \Kalaweit\View\Annual_report\Component\Donation_one_shot)->render('donation_one_shot_dulan_count','Nombre de dons dulan',$data2);
        $chart3 = (new \Kalaweit\View\Annual_report\Component\Donation_one_shot)->render('donation_one_shot_foret_count','Nombre de dons forêt',$data3);

        $chart4 = (new \Kalaweit\View\Annual_report\Component\Donation_one_shot)->render('donation_one_shot_animal_sum','Somme récoltée dons animaux',$data4);
        $chart5 = (new \Kalaweit\View\Annual_report\Component\Donation_one_shot)->render('donation_one_shot_dulan_sum','Somme récoltée dons dulan',$data5);
        $chart6 = (new \Kalaweit\View\Annual_report\Component\Donation_one_shot)->render('donation_one_shot_foret_sum','Somme récoltée dons forêt',$data6);

        $table1 = (new \Kalaweit\View\Annual_report\Component\Donation_one_shot_table)->render('donation_one_shot_animal_table','Synthèse nombre de dons',[$data_resume1,$data_resume2,$data_resume3]);
        $table2 = (new \Kalaweit\View\Annual_report\Component\Donation_one_shot_table)->render('donation_one_shot_animal_table','Synthèse montant des dons',[$data_resume4,$data_resume5,$data_resume6]);

        $list = (new \Kalaweit\htmlElement\Form_group_select($p_name,$p_option,$p_selected,$p_fontawesome,$p_return))->render();

        $data = [
            "list" => $list,
            "card1" => $card1,
            "card2" => $card2,
            "card3" => $card3,
            "card4" => $card4,
            "card5" => $card5,
            "card6" => $card6,
            "chart1" => $chart1,
            "chart2" => $chart2,
            "chart3" => $chart3,
            "chart4" => $chart4,
            "chart5" => $chart5,
            "chart6" => $chart6,
            "table1" => $table1,
            "table2" => $table2
        ];

        return (new \Kalaweit\View\Annual_report\Annual_report)->render($data);

    }
}
 ?>
