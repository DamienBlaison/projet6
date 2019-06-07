<?php

namespace Kalaweit\Controller\Component\Asso_adhesion;

/**
 *
 */
class Table_last_adhesion
{

    public function render(){

    $bdd = new \Kalaweit\Manager\Connexion();
    $bdd = $bdd->getBdd();

    $data   = (new \Kalaweit\Manager\asso_adhesion($bdd))->get_last();

    $link = '/www/Kalaweit/member/get?cli_id=';
    $update = '/www/Kalaweit/asso_adhesion/update?adhesion_id=';
    $delete = '/www/Kalaweit/asso_adhesion/delete?adhesion_id=';
    $add = '/www/Kalaweit/asso_adhesion/add';


    $table_last_adhesion = (new \Kalaweit\htmlElement\Table_without_pagination("Les dernieres adhésions",$data,'Table_last_adhesion',$link,$update,$delete,$add))->render();

    return  $table_last_adhesion;

    }

}
