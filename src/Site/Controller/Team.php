<?php
namespace Site\Controller;
/**
 *
 */
class Team
{
    function render(){

        $aside = (new \Site\View\Aside())->render();

        $content = [ "aside" => $aside];

        return (new \Site\View\Team())->render($content);

    }

}

 ?>
