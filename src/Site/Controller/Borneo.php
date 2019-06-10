<?php
namespace Site\Controller;
/**
 *
 */
class Borneo{

    function render(){

        $aside = (new \Site\View\Aside())->render();

        $content = [ "aside" => $aside];

        return (new \Site\View\Borneo())->render($content);

    }

}

 ?>
