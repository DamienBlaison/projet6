<?php
namespace Kalaweit\View\Asso_donation;

/**
*
*/

class Asso_donation {

    function render($param)
    {
        require_once( __DIR__ .'/../head.php');

        $asso_donation  = '';
        $asso_donation .= '<div class="container-fluid" style="padding-left:0px;">';
        $asso_donation .= '<form class="content" method="post">';

        $asso_donation .= '<div class=" container-fluid " >'.$param['add_don']['box_donation'].'</div>';


        $asso_donation .= '<div class=" container-fluid " >'.$param['last_donation'].'</div>';

        $asso_donation .= '</div>';
        $asso_donation .= '</div>';
        $asso_donation .= '</form>';
        $asso_donation .= '</div>';

        echo $asso_donation;

    require_once( __DIR__ .'/../footer.php');

    }

    function update($param){

        require_once( __DIR__ .'/../head.php');

        $asso_donation  = '';
        $asso_donation .= '<div class="container-fluid" style="padding-left:0px;">';
        $asso_donation .= '<form class="content" method="post">';

        $asso_donation .= '<div class=" container-fluid " >'.$param['add_don']['box_donation'].'</div>';

        $asso_donation .= '</div>';
        $asso_donation .= '</div>';
        $asso_donation .= '</form>';
        $asso_donation .= '</div>';

        echo $asso_donation;

    require_once( __DIR__ .'/../footer.php');

    }

    function render_add($param){

        require_once( __DIR__ .'/../head.php');

        $asso_donation  = '';
        $asso_donation .= '<div class="container-fluid" style="padding-left:0px;">';
        $asso_donation .= '<form class="content" method="POST">';

        $asso_donation .= '<div class=" container-fluid " >'.$param['box_donation'].'</div>';
        $asso_donation .= '<div class=" container-fluid " >'.$param['last_donation'].'</div>';

        $asso_donation .= '</div>';
        $asso_donation .= '</div>';

        $asso_donation .= '</form>';

        $asso_donation .= '</div>';

        echo $asso_donation;

    require_once( __DIR__ .'/../footer.php');

    }
}
