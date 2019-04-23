<?php

namespace Kalaweit\Controller\Component\Member;

/**
 *
 */
class Member_donation_animal
{
    use \Kalaweit\Transverse\Get_param_request;

    function render(){

            $param_request = $this->Get_param_request();

            $bddM = new \Kalaweit\Manager\Connexion();
            $bddM = $bddM->getBdd();


            $asso_donationM        = new \Kalaweit\Manager\Asso_donation($bddM);

            $list = $asso_donationM->get_donation_by_member($param_request);

                $data =[
                "content"             => $list["list_donation"],
                "head"              => $list["head"],
                "count"             => $list["count"][0],
                "page"              => ceil(($list["count"][0])/15)
            ];

            $box_title = 'Dons pour les animaux';
            $id = 'donation_animal_by_member';
            $link = '/www/Kalaweit/asso_cause/get?cau_id=';
            $update = 'http://localhost:8888/www/Kalaweit/asso_donation/update?don_id=';
            $delete = 'http://localhost:8888/www/Kalaweit/asso_donation/delete?don_id=';
            $add = 'http://localhost:8888/www/Kalaweit/asso_donation/add?cli_id='.$_GET["cli_id"];


            $return = (new \Kalaweit\htmlElement\Table($box_title,$data,$id,$link,$update,$delete,$add))->render();

        return $return;


}
}
