<?php namespace Site\Controller;
/**
 *
 */
class Gibbon_gallery
{

    function render(){

        $aside = (new \Site\View\Aside())->render();

        $content = [ "aside" => $aside];

        return (new \Site\View\Gibbon_gallery())->render($content);
    }
}
 ?>
