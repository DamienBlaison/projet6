<?php
namespace Site\Controller;
/**
 *
 */
class Gibbon
{
    function render(){

        $aside = (new \Site\View\Aside())->render();

        $content = [ "aside" => $aside];

        return (new \Site\View\Gibbon())->render($content);

    }

}

 ?>
