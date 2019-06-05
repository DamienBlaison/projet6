<?php
namespace Kalaweit\View\Asso_donation_forest;

/**
*
*/

class Asso_donation_forest {

    function render_list($param)
    {
        require_once( __DIR__ .'/../head.php');

        $asso_donation_forest  = '';
        $asso_donation_forest .= '<div class="container-fluid" style="padding-left:0px;">';
        $asso_donation_forest .= '<form class="content" method="post">';

        $asso_donation_forest .= '<div class=" container-fluid " >'.$param['add_donation_forest']['box_donation_forest'].'</div>';


        $asso_donation_forest .= '<div class=" container-fluid " >'.$param['last_donation_forest'].'</div>';

        $asso_donation_forest .= '</div>';
        $asso_donation_forest .= '</div>';
        $asso_donation_forest .= '</form>';
        $asso_donation_forest .= '</div>';

        echo $asso_donation_forest;

    require_once( __DIR__ .'/../footer.php');

    }

    function render_update($param){


        require_once( __DIR__ .'/../head.php');

        $asso_donation_forest  = '';
        $asso_donation_forest .= '<div class="container-fluid" style="padding-left:0px;">';
        $asso_donation_forest .= '<form class="content" method="POST">';

        $asso_donation_forest .= '<div class=" container-fluid " >'.$param['add_donation_forest']['box_donation_forest'].'</div>';

        $asso_donation_forest .= '</div>';
        $asso_donation_forest .= '</div>';
        $asso_donation_forest .= '</form>';
        $asso_donation_forest .= '</div>';

        echo $asso_donation_forest;

    require_once( __DIR__ .'/../footer.php');

    }

    function render_add($param){

        require_once( __DIR__ .'/../head.php');

        $asso_donation_forest  = '';
        $asso_donation_forest .= '<div class="container-fluid" style="padding-left:0px;">';
        $asso_donation_forest .= '<form class="content" method="POST">';

        $asso_donation_forest .= '<div class=" container-fluid " >'.$param['box_donation_forest'].'</div>';
        $asso_donation_forest .= '<div class=" container-fluid " >'.$param['last_donation_forest'].'</div>';

        $asso_donation_forest .= '</div>';
        $asso_donation_forest .= '</div>';

        $asso_donation_forest .= '</form>';

        $asso_donation_forest .= '</div>';

        echo $asso_donation_forest;

    require_once( __DIR__ .'/../footer.php');

    echo '

    <script>

    function createUser(){

        var elmt = document.getElementsByClassName("fa fa-user");
        console.log(elmt);

        for (var i = 0; i < elmt.length; i++) {
            elmt[i].addEventListener("click", function(){document.location.href="/www/Kalaweit/member/add";});
        };

    };

    createUser()
    </script>
    ';

    }
}
