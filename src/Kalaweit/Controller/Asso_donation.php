<?php
namespace Kalaweit\Controller;

/**
 *
 */
class Asso_donation
{

    function add () {

        $bdd = new \Kalaweit\Manager\Connexion();
        $bdd = $bdd->getBdd();

        if (
            isset($_POST['donation_mnt']) &&  $_POST['donation_mnt'] > 0
            )
        {

            (new \Kalaweit\Manager\Asso_donation($bdd))->add();

        }

        (new \Kalaweit\Controller\Component\Asso_donation\Box_add)->render();

    }

    function delete()

    {
        $bdd = new \Kalaweit\Manager\Connexion();
        $bdd = $bdd->getBdd();

            (new \Kalaweit\Manager\Asso_donation($bdd))->delete($_GET['don_id']);

    }

    function update()

    {
        $p_render = [
            "add_don"=>(new \Kalaweit\Controller\Component\Asso_donation\Asso_donation)->update()
        ];

        return (new \Kalaweit\View\Asso_donation\Asso_donation)->update($p_render);
            //(new \Kalaweit\Manager\Asso_donation($bdd))->update($_GET['don_id']);

    }

    function get_list()

    {
        $p_render = (new \Kalaweit\Controller\Component\Asso_donation\Table_list_donation)->render();

        return (new \Kalaweit\View\Table\Table_filter)->render($p_render);

    }





}
