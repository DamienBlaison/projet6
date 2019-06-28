<?php namespace Site\Controller;
/**
 *
 */
class Gibbon_gallery_thanks
{

    function render(){

        $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();

        $aside = (new \Site\View\Aside())->render();

        $gallery_gibbon = (new \Kalaweit\Manager\Asso_cause($bdd))->get_info_gallery();


        $content = [
            "aside" => $aside,
            "gallery" =>$gallery_gibbon
        ];


        return (new \Site\View\Gibbon_gallery_thanks())->render($content);
    }
}
 ?>
