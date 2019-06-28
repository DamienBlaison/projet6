<?php namespace Kalaweit\Controller;

/**
*
*/
class Maintenance
{
    function update(){

        $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();


        if(isset($_POST["delete_receipt"]) && $_POST['name_receipt'] != ''){

            $file = $_POST['name_receipt'];

            if (file_exists( __DIR__ .'/../../../Documents/Receipt/'.$file)){

                echo '<script> alert("le fichier existe");</script>';

                (new \Kalaweit\Manager\Receipt($bdd))->delete($file);

            } else {

                echo '<script> alert("le fichier n\'existe pas");</script>';
            }

        };



        $delete_receipt = (new \Kalaweit\htmlElement\Form_group_input_submit(
            'name_receipt',
            'nom du reçu',
            '',
            'col-md-10',
            'delete_receipt',
            'col-md-2 btn btn-danger',
            'Supprimer le reçu'

        ));

        $box_maintenance_content = [

            "delete_receipt" => $delete_receipt->render(),

        ];

        $box_maintenance = (new \Kalaweit\htmlElement\Box('Opérations de maintenance','box-primary',$box_maintenance_content,12));


        $param = [

            "box_maintenance" => $box_maintenance


        ];


        return (new \Kalaweit\View\Maintenance\Maintenance())->render($param);

    }

}
?>
