<?php
namespace Site\Controller;
/**
 *
 */
class Home
{
    function render(){

        $aside = (new \Site\View\Aside())->render();

        $content = [ "aside" => $aside];

        return (new \Site\View\Home())->render($content);

    }

}
