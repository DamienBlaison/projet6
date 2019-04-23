<?php
namespace Kalaweit\View\Table;

/**
 *
 */
class Table_filter
{

    function render($p_render)
    {
        require_once( __DIR__ .'/../head.php');

        $render  = '';
        $render .= '<div class="container-fluid" style="padding-left:0px;">';
        $render .= '<section class="content">';
        $render .= '<div class="box">';
        $render .= '</br>';

        $render .= (new \Kalaweit\htmlElement\Table_filter)->render($p_render["fields"],$p_render["data"],$p_render["id"]);

        $render .= '</div>';
        $render .= '</div>';
        $render .= '</section>';
        $render .= '</div>';

        echo $render;

        require_once( __DIR__ .'/../footer.php');
    }
}
