<?php

/**** classe permettant la gestion des infos liées au membres ****/
namespace Kalaweit\Controller;

class Member
{
    /** méthode de gestion d'un membre **/

    function get(){

        $p_render = [

        "content_tab1" => $content_tab1 = (new  \Kalaweit\Controller\Component\Member\Member_info)->render(),


        "content_tab2" => $content_tab2 =

        (new  \Kalaweit\Controller\Component\Member\Member_adhesion)->render().
        (new  \Kalaweit\Controller\Component\Member\Member_donation_asso)->render().
        (new  \Kalaweit\Controller\Component\Member\Member_donation)->render().
        (new  \Kalaweit\Controller\Component\Member\Member_donation_forest)->render().
        (new  \Kalaweit\Controller\Component\Member\Member_donation_dulan)->render(),

        "content_tab3" => $content_tab3 = (new  \Kalaweit\Controller\Component\Member\Member_receipt_annual)->render(),

        "content_tab4" => $content_tab4 = (new \Kalaweit\Controller\Component\Member\Member_send_mail)->render()

    ];

        return     (new \Kalaweit\View\Member\Member\Member)->render($p_render);
    }

    /** méthode de gestion liste des membres **/

    function get_list()

    {
        $p_render = (new \Kalaweit\Controller\Component\Member\Table_member)->render();

        return (new \Kalaweit\View\Table\Table_filter)->render($p_render);

    }

    /** méthode d ajout d'un membre **/

    function add(){

        $p_render = [

        "content_tab1" => $content_tab1 = (new  \Kalaweit\Controller\Component\Member\Member_info)->render(),
        "content_tab2" => $content_tab2 = '',
        "content_tab3" => $content_tab3 = '',
        "content_tab4" => $content_tab4 = ''


    ];

        return     (new \Kalaweit\View\Member\Member\Member)->render($p_render);

    }

    /** méthode de suppression d'un membre **/

    function delete(){

        $bdd = (new \Kalaweit\Manager\Connexion)->getBdd();

        return (new \Kalaweit\Manager\Member($bdd))->delete();

    }


}
