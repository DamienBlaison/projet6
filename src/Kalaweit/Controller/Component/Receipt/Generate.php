<?php
namespace Kalaweit\Controller\Component\Receipt;

/**
 *
 */
class Generate
{
    use \Kalaweit\Transverse\Get_param_request;

    function render(){


        $param_request = $this->Get_param_request();

        $bddM = new \Kalaweit\Manager\Connexion();
        $bddM = $bddM->getBdd();

        $receipts      = new \Kalaweit\Manager\Receipt($bddM);

        $list = $receipts->generate($param_request);

        $request = '';

        //$fields =

        //[

        //    [
        //        "type_balise"   => 'input',
        //        "id"            => 'cli_firstname',
        //        "type"          => 'text',
        //        "name"          => 'cli_firstname',
        //        "placeholder"   => 'Prénom',
        //        "class"         => '5',
        ////    ]

        //];

        $data =[

            "table"             => $list["content"],
            "head"              => $list["head"],
            "count"             => $list["count"][0],
            "title"             => 'Liste des adhésions'

        ];

         return $p_render = [
            "fields"     => [],
            "data"       => $data,
            "id"         => "Table_list_adhesion"
        ];

    }

}
