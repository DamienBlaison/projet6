<?php
namespace Kalaweit\Controller;

/**
 *
 */
class Asso_donation_forest
{

    function add () {

        $bdd = new \Kalaweit\Manager\Connexion();
        $bdd = $bdd->getBdd();

        if (isset($_POST['donation_forest_mnt']) &&  $_POST['donation_forest_mnt'] > 0)

        {
            (new \Kalaweit\Manager\Asso_donation_forest($bdd))->add();
        }

        (new \Kalaweit\Controller\Component\Asso_donation_forest\Box_add)->render();

    }

    function delete()

    {
        $bdd = new \Kalaweit\Manager\Connexion();
        $bdd = $bdd->getBdd();

            (new \Kalaweit\Manager\Asso_donation_forest($bdd))->delete($_GET['donation_forest_id']);

    }

    function update()

    {

        $p_render = [
            "add_donation_forest"=>(new \Kalaweit\Controller\Component\Asso_donation_forest\Asso_donation_forest)->update()
        ];

        return (new \Kalaweit\View\Asso_donation_forest\Asso_donation_forest)->render_update($p_render);
            //(new \Kalaweit\Manager\Asso_donation_forest($bdd))->update($_GET['don_id']);

    }

    function get_list()

    {
        $p_render = (new \Kalaweit\Controller\Component\Asso_donation_forest\Table_list_donation_forest)->render();

        return (new \Kalaweit\View\Table\Table_filter)->render($p_render);

    }





}
