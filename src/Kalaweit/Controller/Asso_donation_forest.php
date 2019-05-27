<?php
/* classe permettant de gérer les dons FORET */

namespace Kalaweit\Controller;

class Asso_donation_forest
{
    /** méthode d'appel pour l'ajout d'un don FORET **/

    function add () {

        /* instanciation de la connexion a la bdd */

        $bdd = new \Kalaweit\Manager\Connexion();
        $bdd = $bdd->getBdd();

        /* verification de la présence des données d'entrée et appel de la methode d'ajout du manager */

        if (isset($_POST['donation_forest_mnt']) &&  $_POST['donation_forest_mnt'] > 0)

        {
            (new \Kalaweit\Manager\Asso_donation_forest($bdd))->add();
        }

        /* instanciation du composant Box_add */

        (new \Kalaweit\Controller\Component\Asso_donation_forest\Box_add)->render();

    }

    /** méthode d'appel pour la suppression d'un don FORET **/

    function delete()

    {

        /* instanciation de la connexion a la bdd */

        $bdd = new \Kalaweit\Manager\Connexion();
        $bdd = $bdd->getBdd();

        /* lancement du traitemetn de suppression */

        (new \Kalaweit\Manager\Asso_donation_forest($bdd))->delete();

    }

    /** méthode d'appel pour la MAJ d'un don FORET **/

    function update()

    {

        $p_render = [
            "add_donation_forest"=>(new \Kalaweit\Controller\Component\Asso_donation_forest\Asso_donation_forest)->update()
        ];

        return (new \Kalaweit\View\Asso_donation_forest\Asso_donation_forest)->render_update($p_render);

    }

    /** méthode d'appel pour la liste des don FORET **/

    function get_list()

    {
        /* Instanciation de la l'objet représentant la liste des dons FORET */

        $p_render = (new \Kalaweit\Controller\Component\Asso_donation_forest\Table_list_donation_forest)->render();

        /* passage des param à la vue et instanciation de cette derniere */

        return (new \Kalaweit\View\Table\Table_filter)->render($p_render);

    }





}
