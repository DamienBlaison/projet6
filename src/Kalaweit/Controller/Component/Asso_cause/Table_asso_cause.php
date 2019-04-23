<?php
namespace Kalaweit\Controller\Component\Asso_cause;

/**
 *
 */
class Table_asso_cause
{
    use \Kalaweit\Transverse\Get_param_request;

    function render(){

        $param_request = $this->Get_param_request();

        $bddM = new \Kalaweit\Manager\Connexion();
        $bddM = $bddM->getBdd();

        $asso_causeM        = new \Kalaweit\Manager\Asso_cause($bddM);

        $list = $asso_causeM->get_list($param_request);

        $request = '';

        if(isset($list[5])){
            $page = $list[5];
        }else{
            $page = 1;
        }

        if(isset($_GET['cau_id'])){$cau_id = $_GET['cau_id']; } else { $cau_id = '';};
        if(isset($_GET['ac_name'])){$ac_name = $_GET['ac_name']; } else { $ac_name = '';};
        if(isset($_GET['ac_site'])){$ac_site = $_GET['ac_site']; } else { $ac_site = '';};
        if(isset($_GET['actd_2'])){$actd_2 = $_GET['actd_2']; } else { $actd_2 = '';};
        if(isset($_GET['actd_4'])){$actd_4 = $_GET['actd_4']; } else { $actd_4 = '';};
        if(isset($_GET['actd_3'])){$actd_3 = $_GET['actd_3']; } else { $actd_3 = '';};
        if(isset($_GET['actd_1'])){$actd_1 = $_GET['actd_1']; } else { $actd_1 = '';};
        if(isset($_GET['actd_5'])){$actd_5 = $_GET['actd_5']; } else { $actd_5 = '';};
        if(isset($_GET['actd_7'])){$actd_7 = $_GET['actd_7']; } else { $actd_7 = '';};
        if(isset($_GET['actd_8'])){$actd_8 = $_GET['actd_8']; } else { $actd_8 = '';};
        if(isset($_GET['actd_9'])){$actd_9 = $_GET['actd_9']; } else { $actd_9 = '';};

        $fields =

        [

            [
                "type_balise"   => 'input',
                "id"            => 'ac_name',
                "type"          => 'text',
                "name"          => 'ac_name',
                "placeholder"   => 'Nom',
                "class"         => '5',
                "value"         =>  $ac_name
            ]

            ,

            [
                "type_balise"   => 'input',
                "id"            => 'actd_1',
                "type"          => 'text',
                "name"          => 'actd_1',
                "placeholder"   => 'Localisation',
                "class"         => '3',
                "value"         =>  $actd_1
            ]
            ,
            [
                "type_balise"   => 'input',
                "id"            => 'actd_2',
                "type"          => 'text',
                "name"          => 'actd_2',
                "placeholder"   => 'Sexe',
                "class"         => '2',
                "value"         =>  $actd_2
            ]

            ,

            [
                "type_balise"   => 'input',
                "id"            => 'actd_4',
                "type"          => 'text',
                "name"          => 'actd_4',
                "placeholder"   => 'Année de naissance',
                "class"         => '2',
                "value"         =>  $actd_4
            ]

            ,

            [
                "type_balise"   => 'input',
                "id"            => 'actd_7',
                "type"          => 'text',
                "name"          => 'actd_7',
                "placeholder"   => 'Année de décés',
                "class"         => '2',
                "value"         =>  $actd_7
            ]

            ,

            [
                "type_balise"   => 'input',
                "id"            => 'actd_8',
                "type"          => 'text',
                "name"          => 'actd_8',
                "placeholder"   => 'Adoption',
                "class"         => '3',
                "value"         =>  $actd_8
            ]

            ,

            [
                "type_balise"   => 'input',
                "id"            => 'actd_9',
                "type"          => 'text',
                "name"          => 'actd_9',
                "placeholder"   => 'En captivité',
                "class"         => '3',
                "value"         =>  $actd_9
            ]

            ,

            [
                "type_balise"   => 'input',
                "id"            => 'ac_site',
                "type"          => 'text',
                "name"          => 'ac_site',
                "placeholder"   => 'Site : O/N',
                "class"         => '2',
                "value"         =>  $ac_site
            ]

        ];

        //($list);

        $data =[

            "table"             => $list["list_member"],
            "head"              => $list["head"],
            "count"             => $list["count"][0],
            "title"             => 'Liste des animaux'

        ];



        return $p_render = [
            "fields"     => $fields ,
            "data"       => $data
        ];



    }

}
