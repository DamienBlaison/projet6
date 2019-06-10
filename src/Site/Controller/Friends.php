<?php
namespace Site\Controller;
/**
 *
 */
class Friends{

    function render(){

        $aside = (new \Site\View\Aside())->render();

        $content = [ "aside" => $aside];

        return (new \Site\View\Friends())->render($content);

    }

}

 ?>
