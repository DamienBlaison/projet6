<?php
namespace Kalaweit\Controller\Component\Asso_donation_forest;

/**
 *
 */
class Table_list_donation_forest
{
    use \Kalaweit\Transverse\Get_param_request;

    function render(){


        $param_request = $this->Get_param_request();

        $bddM = new \Kalaweit\Manager\Connexion();
        $bddM = $bddM->getBdd();

        $asso_donation_forest       = new \Kalaweit\Manager\Asso_donation_forest($bddM);

        $list = $asso_donation_forest->get_list($param_request);

        $request = '';

        if(isset($list[5])){
            $page = $list[5];
        }else{
            $page = 1;
        }

        if(isset($_GET['donation_forest_id'])){$donation_forest_id = $_GET['donation_forest_id']; } else { $donation_forest_id = '';};
        if(isset($_GET['cli_id'])){$cli_id = $_GET['cli_id']; } else { $cli_id = '';};
        if(isset($_GET['cli_firstname'])){$cli_firstname = $_GET['cli_firstname']; } else { $cli_firstname = '';};
        if(isset($_GET['cli_lastname'])){$cli_lastname = $_GET['cli_lastname']; } else { $cli_lastname = '';};

        $fields =

        [

            [
                "type_balise"   => 'input',
                "id"            => 'donation_forest_id',
                "type"          => 'text',
                "name"          => 'donation_forest_id',
                "placeholder"   => 'Id_donation_forest',
                "class"         => '2',
                "value"         =>  $donation_forest_id
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

        ];

        $data =[

            "table"             => $list["list_donation_forest"],
            "head"              => $list["head"],
            "count"             => $list["count"][0],
            "title"             => "Dons à destination des fôrets"

        ];

         return $p_render = [
            "fields"     => $fields ,
            "data"       => $data,
            "id"         => "Table_list_donation_forest"
        ];

    }

}
