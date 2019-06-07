<?php

/* class permettande de générer le contenu de table des dons par memebre*/


namespace Kalaweit\Controller\Component\Member;

class Member_adhesion
{

    function render(){

        /* initialisation de la connexion a la BDD */

        $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();

        /* initialisation des paramètres à passer a la methode gérant les dons par membre de l'objet asso_donation_dulan */

        $p_nb_by_page = 5;
        $page = 1;

        /* creation de l'objet et utilsation de la méthode */

        $p_data = (new \Kalaweit\Manager\Asso_adhesion($bdd))->get_adhesion_by_member($p_nb_by_page,$page);

        /* initialisation des paramètres nécessaire à la composition de la vue du composant Table */

        $p_name = "Adhesion";
        $p_id = "adhesion_by_member";
        $p_update = "www/Kalaweit/asso_adhesion/update?adhesion_id=";
        $p_delete = "www/Kalaweit/asso_adhesion/delete?adhesion_id=";
        $p_print = "";
        $p_add = "www/Kalaweit/asso_adhesion/add?cli_id=".$_GET["cli_id"];

        /* Instanciation et application de le methode render de l'objet Table */

        return (new \Kalaweit\htmlElement\Table($p_name,$p_data,$p_id,$p_update,$p_delete,$p_print,$p_add,$p_nb_by_page))->render();

    }
}
