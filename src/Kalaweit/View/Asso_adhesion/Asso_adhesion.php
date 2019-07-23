<?php
namespace Kalaweit\View\Asso_adhesion;

/**
*
*/

class Asso_adhesion {

    function render_list($param)
    {
        require_once( __DIR__ .'/../Head.php');

        $asso_adhesion  = '';
        $asso_adhesion .= '<div class="container-fluid" style="padding-left:0px;">';
        $asso_adhesion .= '<form class="content" method="post">';

        $asso_adhesion .= '<div class=" container-fluid " >'.$param['add_adhesion']['box_adhesion'].'</div>';


        $asso_adhesion .= '<div class=" container-fluid " >'.$param['last_adhesion'].'</div>';

        $asso_adhesion .= '</div>';
        $asso_adhesion .= '</div>';
        $asso_adhesion .= '</form>';
        $asso_adhesion .= '</div>';

        echo $asso_adhesion;

    require_once( __DIR__ .'/../footer.php');

    }

    function render_update($param){


        require_once( __DIR__ .'/../Head.php');

        $asso_adhesion  = '';
        $asso_adhesion .= '<div class="container-fluid" style="padding-left:0px;">';
        $asso_adhesion .= '<form class="content" method="POST">';

        $asso_adhesion .= '<div class=" container-fluid " >'.$param['add_adhesion']['box_adhesion'].'</div>';

        $asso_adhesion .= '</div>';
        $asso_adhesion .= '</div>';
        $asso_adhesion .= '</form>';
        $asso_adhesion .= '</div>';

        echo $asso_adhesion;

    require_once( __DIR__ .'/../footer.php');

    }

    function render_add($param){

        require_once( __DIR__ .'/../Head.php');

        $asso_adhesion  = '';
        $asso_adhesion .= '<div class="container-fluid" style="padding-left:0px;">';
        $asso_adhesion .= '<form class="content" method="POST">';

        $asso_adhesion .= '<div class=" container-fluid " >'.$param['box_adhesion'].'</div>';
        $asso_adhesion .= '<div class=" container-fluid " >'.$param['last_adhesion'].'</div>';

        $asso_adhesion .= '</div>';
        $asso_adhesion .= '</div>';

        $asso_adhesion .= '</form>';

        $asso_adhesion .= '</div>';

        echo $asso_adhesion;

    require_once( __DIR__ .'/../footer.php');

    }
}
