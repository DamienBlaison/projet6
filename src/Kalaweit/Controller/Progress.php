<?php namespace Kalaweit\Controller;

class Progress
{

    function Receipt_annual_generation_progress(){

        $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();

        return (new \Kalaweit\Manager\Receipt_annual($bdd))->get_achievment();
    }

}


?>
