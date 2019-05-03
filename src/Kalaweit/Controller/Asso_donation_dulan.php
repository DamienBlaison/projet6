<?php
namespace Kalaweit\Controller;

/**
 *
 */
class Asso_donation_dulan
{

    function add () {

        $bdd = new \Kalaweit\Manager\Connexion();
        $bdd = $bdd->getBdd();

        if (isset($_POST['donation_dulan_mnt']) &&  $_POST['donation_dulan_mnt'] > 0)

        {
            (new \Kalaweit\Manager\Asso_donation_dulan($bdd))->add();
        }

        (new \Kalaweit\Controller\Component\Asso_donation_dulan\Box_add)->render();

    }

    function delete()

    {
        $bdd = new \Kalaweit\Manager\Connexion();
        $bdd = $bdd->getBdd();

            (new \Kalaweit\Manager\Asso_donation_dulan($bdd))->delete($_GET['don_id']);

    }

    function update()

    {

        $p_render = [
            "add_donation_dulan"=>(new \Kalaweit\Controller\Component\Asso_donation_dulan\Asso_donation_dulan)->update()
        ];

        return (new \Kalaweit\View\Asso_donation_dulan\Asso_donation_dulan)->render_update($p_render);
            //(new \Kalaweit\Manager\Asso_donation_dulan($bdd))->update($_GET['don_id']);

    }

    function get_list()

    {
        $p_render = (new \Kalaweit\Controller\Component\Asso_donation_dulan\Table_list_donation_dulan)->render();

        return (new \Kalaweit\View\Table\Table_filter)->render($p_render);

    }





}
