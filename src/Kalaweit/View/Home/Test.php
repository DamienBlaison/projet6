<?php
namespace Kalaweit\View\Home;

/**
 *
 */
class Test
{

    function render(){

        require_once( __DIR__ .'/../head.php');

        $home = '';
        $home = '<div class="container-fluid"> Espace de test </div>';

        echo $home;

        require_once( __DIR__ .'/../footer.php');

        require_once(__DIR__ .'/../../test_ajax.php');



    }
}
