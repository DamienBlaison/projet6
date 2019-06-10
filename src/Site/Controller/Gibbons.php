<?php
namespace Site\Controller;
/**
 *
 */
class Gibbons
{
    function render(){

        $aside = (new \Site\View\Aside())->render();

        $content = [ "aside" => $aside];

        return (new \Site\View\Gibbons())->render($content);

    }

}

 ?>
