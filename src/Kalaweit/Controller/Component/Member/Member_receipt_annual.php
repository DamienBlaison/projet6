<?php

/* class permettande de générer le contenu de table des dons par memebre*/


namespace Kalaweit\Controller\Component\Member;

class Member_receipt_annual
{

    function render(){

        /* initialisation de la connexion a la BDD */

        $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();

        /* initialisation des paramètres à passer a la methode gérant les dons par membre de l'objet asso_donation_dulan */

        $p_nb_by_page = 15;
        $page = 1;

        /* creation de l'objet et utilsation de la méthode */

        $p_data = (new \Kalaweit\Manager\Receipt($bdd))->get_receipt_annual_by_member($p_nb_by_page,$page);

        $check_rf = 0;

        foreach ($p_data["content"]as $key => $value) {

            if ($value[0] === date('Y')) { $check_rf += 1; }
            // code...
        };

        /* initialisation des paramètres nécessaire à la composition de la vue du composant Table */

        $receipt_resume = (new \Kalaweit\Manager\Receipt($bdd))->resume_donations_year_by_member($_GET["cli_id"]);

        $p_name = "Receipt_annual";
        $p_id = "Receipt_annual";
        $p_update = "";
        $p_delete = "";
        $p_print = "www/Kalaweit/Documents/Receipt/";

        if($receipt_resume[0]["sum(don_mnt)"] == NULL){

                $p_add = '/localhost:8888'.$_SERVER['REQUEST_URI'];

        } else {

            if($check_rf != 0){

                $p_add = '/localhost:8888'.$_SERVER['REQUEST_URI'];
            } else {

            $p_add = "www/Kalaweit/Receipt_annual/add?cli_id=".$_GET["cli_id"];

            }
        }

        $p_position_status = 3;


        /* Instanciation et application de le methode render de l'objet Table */

        return (new \Kalaweit\htmlElement\Table($p_name,$p_data,$p_id,$p_update,$p_delete,$p_print,$p_position_status,$p_add,$p_nb_by_page))->render();

    }
}
