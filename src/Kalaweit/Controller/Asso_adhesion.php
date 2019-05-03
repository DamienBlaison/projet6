<?php
namespace Kalaweit\Controller;

/**
 *
 */
class Asso_adhesion
{

    function add () {

        $bdd = new \Kalaweit\Manager\Connexion();
        $bdd = $bdd->getBdd();

        if (isset($_POST['adhesion_mnt']) &&  $_POST['adhesion_mnt'] > 0)

        {
            (new \Kalaweit\Manager\Asso_adhesion($bdd))->add();
        }

        (new \Kalaweit\Controller\Component\Asso_adhesion\Box_add)->render();

    }

    function delete()

    {
        $bdd = new \Kalaweit\Manager\Connexion();
        $bdd = $bdd->getBdd();

            (new \Kalaweit\Manager\Asso_adhesion($bdd))->delete($_GET['adhesion_id']);

    }

    function update()

    {

        $p_render = [
            "add_adhesion"=>(new \Kalaweit\Controller\Component\Asso_adhesion\Asso_adhesion)->update()
        ];

        return (new \Kalaweit\View\Asso_adhesion\Asso_adhesion)->render_update($p_render);
            //(new \Kalaweit\Manager\Asso_adhesion($bdd))->update($_GET['don_id']);

    }

    function get_list()

    {
        $p_render = (new \Kalaweit\Controller\Component\Asso_adhesion\Table_list_adhesion)->render();

        return (new \Kalaweit\View\Table\Table_filter)->render($p_render);

    }







}
