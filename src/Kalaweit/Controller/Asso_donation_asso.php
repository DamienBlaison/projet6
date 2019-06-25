<?php

/* classe permettant de gérer les dons*/

namespace Kalaweit\Controller;

class Asso_donation_asso
{
    /** méthode d'appel pour l'ajout d'un don **/

    function add () {

        /* instanciation de la connexion a la bdd */

        $bdd = new \Kalaweit\Manager\Connexion();
        $bdd = $bdd->getBdd();

        /* verification de la présence des données d'entrée et appel de la methode d'ajout du manager */


        if (
            isset($_POST['donation_mnt']) &&  $_POST['donation_mnt'] > 0
            )
        {

            (new \Kalaweit\Manager\Asso_donation_asso($bdd))->add();

        }

        /* instanciation du composant Box_add */

        (new \Kalaweit\Controller\Component\Asso_donation_asso\Box_add)->render();

    }

    /** méthode d'appel pour la suppression d'un don **/

    function delete()

    {

        /* instanciation de la connexion a la bdd */

        $bdd = new \Kalaweit\Manager\Connexion();
        $bdd = $bdd->getBdd();

        /* lancement du traitemetn de suppression */

            (new \Kalaweit\Manager\Asso_donation_asso($bdd))->delete($_GET['don_id']);

    }

    /** méthode d'appel pour la MAJ d'un don **/

    function update()

    {
        $p_render = [
            "add_don"=>(new \Kalaweit\Controller\Component\Asso_donation_asso\Asso_donation_asso)->update()
        ];

        return (new \Kalaweit\View\Asso_donation_asso\Asso_donation_asso)->update($p_render);

    }

    /** méthode d'appel pour la liste des dons **/

    function get_list()

    {
        $p_render = (new \Kalaweit\Controller\Component\Asso_donation_asso\Table_list_donation)->render();

        /* passage des param à la vue et instanciation de cette derniere */

        return (new \Kalaweit\View\Table\Table_filter)->render($p_render);

    }





}
