<?php
namespace Kalaweit\Controller\Component\Asso_donation;

/**
 *
 */
class Table_list_donation
{
    use \Kalaweit\Transverse\Get_param_request;

    function render(){


        $param_request = $this->Get_param_request();

        $bddM = new \Kalaweit\Manager\Connexion();
        $bddM = $bddM->getBdd();

        $asso_donation       = new \Kalaweit\Manager\Asso_donation($bddM);

        $list = $asso_donation->get_list($param_request);

        $request = '';

        if(isset($list[5])){
            $page = $list[5];
        }else{
            $page = 1;
        }

        if(isset($_GET['don_id'])){$don_id = $_GET['don_id']; } else { $don_id = '';};
        if(isset($_GET['cau_name'])){$cau_name = $_GET['cau_name']; } else { $cau_name = '';};
        if(isset($_GET['cli_id'])){$cli_id = $_GET['cli_id']; } else { $cli_id = '';};
        if(isset($_GET['cli_firstname'])){$cli_firstname = $_GET['cli_firstname']; } else { $cli_firstname = '';};
        if(isset($_GET['cli_lastname'])){$cli_lastname = $_GET['cli_lastname']; } else { $cli_lastname = '';};

        $fields =

        [

            [
                "type_balise"   => 'input',
                "id"            => 'don_id',
                "type"          => 'text',
                "name"          => 'don_id',
                "placeholder"   => 'Id_don',
                "class"         => '2',
                "value"         =>  $don_id
            ]

            ,

            [
                "type_balise"   => 'input',
                "id"            => 'cli_id',
                "type"          => 'text',
                "name"          => 'cli_id',
                "placeholder"   => 'Membre_Id',
                "class"         => '2',
                "value"         =>  $cli_id
            ]

            ,

            [
                "type_balise"   => 'input',
                "id"            => 'cli_firstname',
                "type"          => 'text',
                "name"          => 'cli_firstname',
                "placeholder"   => 'Prénom',
                "class"         => '2',
                "value"         =>  $cli_firstname
            ]

            ,

            [
                "type_balise"   => 'input',
                "id"            => 'cli_lastname',
                "type"          => 'text',
                "name"          => 'cli_lastname',
                "placeholder"   => 'Nom',
                "class"         => '2',
                "value"         =>  $cli_lastname
            ]

            ,

            [
                "type_balise"   => 'input',
                "id"            => 'cau_name',
                "type"          => 'text',
                "name"          => 'cau_name',
                "placeholder"   => 'Bénéficiaire',
                "class"         => '2',
                "value"         =>  $cau_name
            ]


        ];

        $data =[

            "table"             => $list["list_donation"],
            "head"              => $list["head"],
            "count"             => $list["count"][0],
            "title"             => "Dons à destination d'animaux",

        ];

         return $p_render = [
            "fields"     => $fields ,
            "data"       => $data,
            "id"         => "Table_list_donation",
        ];

    }

}
