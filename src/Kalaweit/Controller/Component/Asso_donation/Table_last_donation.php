<?php

namespace Kalaweit\Controller\Component\Asso_donation;

/**
 *
 */
class Table_last_donation
{

    public function render(){

    $bdd = new \Kalaweit\Manager\Connexion();
    $bdd = $bdd->getBdd();

    $data   = (new \Kalaweit\Manager\asso_donation($bdd))->get_last();
    $link = '/www/Kalaweit/member/get?cli_id=';
    $update = 'http://localhost:8888/www/Kalaweit/asso_donation/update?don_id=';
    $delete = 'http://localhost:8888/www/Kalaweit/asso_donation/delete?don_id=';
    $add = 'http://localhost:8888/www/Kalaweit/asso_donation/add';

    $table_last_donation = (new \Kalaweit\htmlElement\Table_without_pagination("Les derniers dons",$data,'Table_last_donation',$link,$update,$delete,$add))->render();


    return $table_last_donation;

    }

}
