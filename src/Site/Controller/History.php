<?php
namespace Site\Controller;
/**
 *
 */
class History
{
    function render(){

        $aside = (new \Site\View\Aside())->render();

        $content = [ "aside" => $aside];

        return (new \Site\View\History())->render($content);

    }

}

 ?>
