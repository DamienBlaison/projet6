<?php
namespace Site\Controller;
/**
 *
 */
class Deforestation
{
    function render(){

        $aside = (new \Site\View\Aside())->render();

        $content = [ "aside" => $aside];

        return (new \Site\View\Deforestation())->render($content);

    }

}

 ?>
