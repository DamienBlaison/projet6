<?php
namespace Site\Controller;
/**
 *
 */
class Make_gift{

    function render(){

        $aside = (new \Site\View\Aside())->render();

        $content = [ "aside" => $aside];

        return (new \Site\View\Make_gift())->render($content);

    }

}

 ?>
