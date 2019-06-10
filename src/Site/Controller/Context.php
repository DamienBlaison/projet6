<?php
namespace Site\Controller;
/**
 *
 */
class Context
{
    function render(){

        $aside = (new \Site\View\Aside())->render();

        $content = [ "aside" => $aside];

        return (new \Site\View\Context())->render($content);

    }

}

 ?>
