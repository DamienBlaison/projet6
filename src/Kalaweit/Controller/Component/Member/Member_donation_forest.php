<?php

namespace Kalaweit\Controller\Component\Member;

/**
 *
 */
class Member_donation_forest
{
    use \Kalaweit\Transverse\Get_param_request;

    function render(){

            //$list = explode('/',$_SERVER['REQUEST_URI']);
            //$menu = explode('?',$list[4]);

            $param_request = $this->Get_param_request();

            $bddM = new \Kalaweit\Manager\Connexion();
            $bddM = $bddM->getBdd();

            //$asso_donation         = new \Kalaweit\Model\Asso_donation();
            $asso_donationM        = new \Kalaweit\Manager\Asso_donation_forest($bddM);

            $list = $asso_donationM->get_donation_forest_by_member($param_request);

                $data =[
                "content"             => $list["list_donation_forest"],
                "head"              => $list["head"],
                "count"             => $list["count"][0],
                "page"              => ceil(($list["count"][0])/15)
            ];

            $box_title = 'Dons pour les Forets';
            $id = 'donation_forest_by_member';
            $link = '/www/Kalaweit/asso_cause/get?id=';
            $update = 'http://localhost:8888/www/Kalaweit/asso_donation_forest/update?don_id=';
            $delete = 'http://localhost:8888/www/Kalaweit/asso_donation_forest/delete?don_id=';
            $add = 'http://localhost:8888/www/Kalaweit/asso_donation_forest/add?cli_id='.$_GET["cli_id"];
            $nb_by_page = 5;

        return (new \Kalaweit\htmlElement\Table($box_title,$data,$id,$link,$update,$delete,$add,$nb_by_page))->render();


}
}
