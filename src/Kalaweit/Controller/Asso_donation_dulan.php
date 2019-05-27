<?php
/* classe permettant de gérer les dons DULAN */

namespace Kalaweit\Controller;

class Asso_donation_dulan
{

    /** méthode d'appel pour l'ajout d'un don DULAN **/

    function add () {

        /* instanciation de la connexion a la bdd */

        $bdd = new \Kalaweit\Manager\Connexion();
        $bdd = $bdd->getBdd();

        /* verification de la présence des données d'entrée et appel de la methode d'ajout du manager */

        if (isset($_POST['donation_dulan_mnt']) &&  $_POST['donation_dulan_mnt'] > 0)

        {
            (new \Kalaweit\Manager\Asso_donation_dulan($bdd))->add();
        }

        /* instanciation du composant Box_add */

        (new \Kalaweit\Controller\Component\Asso_donation_dulan\Box_add)->render();

    }

    /** méthode d'appel pour la suppression d'un don DULAN **/

    function delete()

    {

        /* instanciation de la connexion a la bdd */

        $bdd = new \Kalaweit\Manager\Connexion();
        $bdd = $bdd->getBdd();

        /* lancement du traitemetn de suppression */

        (new \Kalaweit\Manager\Asso_donation_dulan($bdd))->delete($_GET['don_id']);

    }

    /** méthode d'appel pour la MAJ d'un don DULAN **/

    function update()

    {

        $p_render = [
            "add_donation_dulan"=>(new \Kalaweit\Controller\Component\Asso_donation_dulan\Asso_donation_dulan)->update()
        ];

        /* passage des param à la vue et instanciation de cette derniere */

        return (new \Kalaweit\View\Asso_donation_dulan\Asso_donation_dulan)->render_update($p_render);

    }

    /** méthode d'appel pour la liste des don DULAN **/

    function get_list()

    {
        /* Instanciation de la l'objet représentant la liste des don DULAN */

        $p_render = (new \Kalaweit\Controller\Component\Asso_donation_dulan\Table_list_donation_dulan)->render();

        /* passage des param à la vue et instanciation de cette derniere */

        return (new \Kalaweit\View\Table\Table_filter)->render($p_render);

    }

}
