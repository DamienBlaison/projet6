<?php
namespace Site\Controller;
/**
 *
 */
class Sumatra{

    function render(){

        $aside = (new \Site\View\Aside())->render();

        $content = [ "aside" => $aside];

        return (new \Site\View\Sumatra())->render($content);

    }

}

 ?>
