<?php
namespace Site\Controller;
/**
 *
 */
class Palm_oil
{
    function render(){

        $aside = (new \Site\View\Aside())->render();

        $content = [ "aside" => $aside];

        return (new \Site\View\Palm_oil())->render($content);

    }

}

 ?>
