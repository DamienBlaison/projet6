<?php
namespace Site\Controller;
/**
 *
 */
class Gift_forest{

    function render(){

        $aside = (new \Site\View\Aside())->render();

        $content = [ "aside" => $aside];

        return (new \Site\View\Gift_forest())->render($content);

    }

}

 ?>
