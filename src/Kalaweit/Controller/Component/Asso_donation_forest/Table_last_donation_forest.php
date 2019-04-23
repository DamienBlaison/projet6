<?php

namespace Kalaweit\Controller\Component\Asso_donation_forest;

/**
 *
 */
class Table_last_donation_forest
{

    public function render(){

    $bdd = new \Kalaweit\Manager\Connexion();
    $bdd = $bdd->getBdd();

    $data   = (new \Kalaweit\Manager\asso_donation_forest($bdd))->get_last();

    $link = '/www/Kalaweit/member/get?cli_id=';
    $update = 'http://localhost:8888/www/Kalaweit/asso_donation_forest/update?donation_forest_id=';
    $delete = 'http://localhost:8888/www/Kalaweit/asso_donation_forest/delete?donation_forest_id=';
    $add = 'http://localhost:8888/www/Kalaweit/asso_donation_forest/add';


    $table_last_donation_forest = (new \Kalaweit\htmlElement\Table_without_pagination("Les derniers dons Foret",$data,'Table_last_donation_forest',$link,$update,$delete,$add))->render();

    return  $table_last_donation_forest;

    }

}
