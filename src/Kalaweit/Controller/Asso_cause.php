<?php
/* classe permettant de gerer les différents traitement liés aux causes */

namespace Kalaweit\Controller;

class Asso_cause
{
    /* méthode d'appel pour la gestion d'une cause spécifique */

    function get(){

        $p_render = [

        "content_tab1" => $content_tab1 = (new  \Kalaweit\Controller\Component\Asso_cause\Asso_cause_info)->render(),
        "content_tab2" => $content_tab2 = (new  \Kalaweit\Controller\Component\Asso_cause\Asso_cause_donation)->render()


    ];

        return     (new \Kalaweit\View\Asso_cause\Asso_cause)->render($p_render);
    }

    /* méthode d'appel pour la gestion de liste des causes */

    function get_list()

    {
        $p_render = (new \Kalaweit\Controller\Component\Asso_cause\Table_asso_cause)->render();


        return (new \Kalaweit\View\Table\Table_filter)->render($p_render);

    }

    /* méthode d'appel pour l'ajout d'une cause */

    function add(){

        $p_render = [

        "content_tab1" => $content_tab1 = (new  \Kalaweit\Controller\Component\Asso_cause\Asso_cause_info)->render(),
        "content_tab2" => ""


    ];

        return     (new \Kalaweit\View\Asso_cause\Asso_cause)->render($p_render);

    }

    /* méthode d'appel pour l'ajout de photo sur une cause */

    function crop(){

            (new \Kalaweit\View\Asso_cause\Crop_photo())->render($_GET["picture"]);

    }


}



 ?>
