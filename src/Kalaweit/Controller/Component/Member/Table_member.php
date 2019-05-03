<?php
namespace Kalaweit\Controller\Component\Member;

/**
 *
 */
class Table_member
{
    use \Kalaweit\Transverse\Get_param_request;

    function render(){

        $param_request = $this->Get_param_request();

        $bddM = new \Kalaweit\Manager\Connexion();
        $bddM = $bddM->getBdd();

        //$member         = new \Kalaweit\Model\Member();
        $memberM        = new \Kalaweit\Manager\Member($bddM);

        $list = $memberM->get_list($param_request);

        $request = '';

        if(isset($list[5])){
            $page = $list[5];
        }else{
            $page = 1;
        }

        if(isset($_GET['cli_firstname'])){ $cli_firstname = $_GET['cli_firstname'];} else { $cli_firstname = '';};
        if(isset($_GET['cli_lastname'])){ $cli_lastname = $_GET['cli_lastname'];} else { $cli_lastname = '';};
        if(isset($_GET['cli_id'])){ $cli_id = $_GET['cli_id'];} else { $cli_id = '';};
        if(isset($_GET['cli_cp'])){ $cli_cp = $_GET['cli_cp'];} else { $cli_cp = '';};
        if(isset($_GET['cli_town'])){ $cli_town = $_GET['cli_town'];} else { $cli_town = '';};


        $fields =

        [

            [
                "type_balise"   => 'input',
                "id"            => 'cli_firstname',
                "type"          => 'text',
                "name"          => 'cli_firstname',
                "placeholder"   => 'Prénom',
                "class"         => '3',
                "value"         =>  $cli_firstname
            ]
            ,

            [
                "type_balise"   => 'input',
                "id"            => 'cli_lastname',
                "type"          => 'text',
                "name"          => 'cli_lastname',
                "placeholder"   => 'Nom',
                "class"         => '3',
                "value"         =>  $cli_lastname
            ]


            ,

            [
                "type_balise"   => 'input',
                "id"            => 'cli_cp',
                "type"          => 'text',
                "name"          => 'cli_cp',
                "placeholder"   => 'Zip',
                "class"         => '2',
                "value"         =>  $cli_cp
            ]

            ,

            [
                "type_balise"   => 'input',
                "id"            => 'cli_town',
                "type"          => 'text',
                "name"          => 'cli_town',
                "placeholder"   => 'Ville',
                "class"         => '2',
                "value"         =>  $cli_town
            ]

        ];

        $data =[
            "table"             => $list["list_member"],
            "head"              => $list["head"],
            "count"             => $list["count"][0],
            "title"             => "Liste des membres"
        ];

        $id = "list_member_filtered";

        return $p_render = [
            "fields"     => $fields ,
            "data"       => $data,
            "id"         => $id
        ];

    }

}
