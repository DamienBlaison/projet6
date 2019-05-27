<?php
/* classe permetttant de récupérer les informations de dons sous forme de liste paginée */

namespace Kalaweit\Controller\Component\Asso_donation;

class Table_list_donation
{
    /* intégartion du trait Get_param_request pour récupération des filtres eventuellemnt appliqués et ou a appliquer */

    use \Kalaweit\Transverse\Get_param_request;

    function render(){

        /* application de la méthode de récupération des params passés dans l'url */

        $param_request = $this->Get_param_request();

        /* instanciation de la connexion a la bdd */

        $bddM = new \Kalaweit\Manager\Connexion();
        $bddM = $bddM->getBdd();

        /* instanction du manager de l'objet asso_donation*/

        $asso_donation       = new \Kalaweit\Manager\Asso_donation($bddM);

        /* récupération des données de la liste en passant les paramètres de filtre) */

        $list = $asso_donation->get_list($param_request);

        $request = '';

        /* vérifcation si des param de request sont passés dans l'url , si oui on initialise les variables pour les afficher dans le formulaire */

        if(isset($_GET['don_id'])){$don_id = $_GET['don_id']; } else { $don_id = '';};
        if(isset($_GET['cau_name'])){$cau_name = $_GET['cau_name']; } else { $cau_name = '';};
        if(isset($_GET['cli_id'])){$cli_id = $_GET['cli_id']; } else { $cli_id = '';};
        if(isset($_GET['cli_firstname'])){$cli_firstname = $_GET['cli_firstname']; } else { $cli_firstname = '';};
        if(isset($_GET['cli_lastname'])){$cli_lastname = $_GET['cli_lastname']; } else { $cli_lastname = '';};

        /* définition des champs de recherches sous forme de tableaux que l'on pourra parcourrir*/

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

        /* définition des champs des infos à passées à la vue via un tableau de data */

        $data =[

            "table"             => $list["list_donation"],
            "head"              => $list["head"],
            "count"             => $list["count"][0],
            "title"             => "Dons à destination d'animaux",

        ];

        /***************************************************************************************************************************/

        /**     Synthese des elements à passer a la vue   **/

        /***************************************************************************************************************************/


         return $p_render = [
            "fields"     => $fields ,
            "data"       => $data,
            "id"         => "Table_list_donation",
        ];

    }

}
