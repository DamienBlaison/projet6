<?php

namespace Kalaweit\Controller\Component\Asso_donation_dulan;

/**
 *
 */
class Table_last_donation_dulan
{

    public function render(){

    $bdd = new \Kalaweit\Manager\Connexion();
    $bdd = $bdd->getBdd();

    $data   = (new \Kalaweit\Manager\asso_donation_dulan($bdd))->get_last();
    $link = '/www/Kalaweit/member/get?cli_id=';
    $update = 'http://localhost:8888/www/Kalaweit/asso_donation_dulan/update?donation_dulan_id=';
    $delete = 'http://localhost:8888/www/Kalaweit/asso_donation_dulan/delete?donation_dulan_id=';
    $add = 'http://localhost:8888/www/Kalaweit/asso_donation_dulan/add';

    $table_last_donation_dulan = (new \Kalaweit\htmlElement\Table_without_pagination("Les derniers don Dulan",$data,'Table_last_donation_dulan',$link,$update,$delete,$add))->render();

    return  $table_last_donation_dulan;

    }

}
