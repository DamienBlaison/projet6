<?php
namespace Site\Controller;
/**
 *
 */
class Gift{

    function render(){

        $aside = (new \Site\View\Aside())->render();

        $content = [ "aside" => $aside];

        return (new \Site\View\Gift())->render($content);

    }

}

 ?>
