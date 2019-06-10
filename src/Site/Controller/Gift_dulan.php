<?php
namespace Site\Controller;
/**
 *
 */
class Gift_dulan{

    function render(){

        $aside = (new \Site\View\Aside())->render();

        $content = [ "aside" => $aside];

        return (new \Site\View\Gift_dulan())->render($content);

    }

}

 ?>
