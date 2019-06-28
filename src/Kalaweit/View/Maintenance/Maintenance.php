<?php
namespace Kalaweit\View\Maintenance;

/**
 *
 */
class Maintenance
{
    function render($param){

        require_once( __DIR__ .'/../head.php');

        $maintenance  = '';
        $maintenance  .= '<section class="content">';
        $maintenance  .= '<form name="member" class="container-fluid" action="" method="post" >';

        $maintenance  .=  ($param["box_maintenance"])->render();

        $maintenance  .= '</form>';
        $maintenance  .= '</section>';

        echo $maintenance;

        require_once( __DIR__ .'/../footer.php');

    }

}

 ?>
