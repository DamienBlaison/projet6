<?php
/* classe permettant de gérer les appels ajax pour maj des tables paginées otr liste globale avec recherche*/
namespace Kalaweit\Controller;

class Ajax_get
{

    /************************************************************/
    /*                  MAJ des dons par membres                */
    /************************************************************/


    /**** méthode pour appeler une MAJ des dons par membre ****/

    function donation_by_member(){

        /* initialisation des variables */

        $p_nb_by_page = $_GET["nb_by_page"];
        $page = $_GET["p"];

        /* instanciation de la connexion a la bdd */

        $bddM = new \Kalaweit\Manager\Connexion();
        $bdd = $bddM->getBdd();

        /* récupération des données , retourne un tableau */

        $array = (new \Kalaweit\Manager\Asso_donation($bdd))->get_donation_by_member($p_nb_by_page,$page);

        /* création de l'affichage des résultats dans une chaine de caractere que l'on passera a la vue */

        $body = "<tbody id='table_donation_by_member'>";

        foreach ($array['content'] as $key => $value) {

            $body .= '<tr role="row" class="odd">';

            foreach ($value as $k => $v) {

                if ($k == 4 && $v == 'OK') { $print = 1; } else { $print = 0;}

                $body .= '<td>'.$v.'</td>';

            }

            $body .= '<td style = "width : 135px;">';
            $body .=    '<a style="margin-right:5px;" href="/www/Kalaweit/asso_donation/update?don_id='.$value[0].'&from=get&cli_id='.$_GET["cli_id"].'}" class="btn btn-primary" id="update_'.$value[0].'"><i class="fa fa-edit"></i></a>';
            $body .=    '<a style="margin-right:5px;" href="/www/Kalaweit/asso_donation/delete?don_id='.$value[0].'" class="btn btn-danger" id="delete_'.$value[0].'" onclick ="return confirm(\'Etes vous sur de vouloir supprimer cet enregistrement\')"><i class="fa  fa-trash"></i></a>';



            $name_receipt = (new \Kalaweit\Manager\Receipt($bdd))->name_receipt($value[0]);


            switch ($print) {
                case 1:

                if( $name_receipt != NULL){

                    $body .=    '<a href="/www/Documents/receipt/'.$name_receipt["rec_number"].'.pdf" target="_blank" style="margin-right:5px;" class="btn btn-success" id="print_'.$value[0].'" ><i class="fa fa-print"></i></a>';

                } else {

                    $body .=    '<a href="/www/Kalaweit/receipt/add?adhesion_id='.$value[0].'" target="_blank" style="margin-right:5px;" class="btn btn-warning" id="print_'.$value[0].'"><i class="fa fa-print"></i></a>';
                }

                    break;

                default:
                    $body .=    '<a href="#" style="margin-right:5px;" class="btn btn-default" id="print_'.$value[0].'"disabled=disabled><i class="fa fa-print"></i></a>';
                    break;
            }

            $body .= '</td>';
            $body .= '</tr>';

            $body .= '</tr>';
        };

        $body .= '</tbody>';

        return $body;

    }

    /**** méthode pour appeler une MAJ des dons asso par membre ****/

    function donation_asso_by_member(){

        /* initialisation des variables */

        $p_nb_by_page = $_GET["nb_by_page"];
        $page = $_GET["p"];

        /* instanciation de la connexion a la bdd */

        $bddM = new \Kalaweit\Manager\Connexion();
        $bdd = $bddM->getBdd();

        /* récupération des données , retourne un tableau */

        $array = (new \Kalaweit\Manager\Asso_donation_asso($bdd))->get_donation_asso_by_member($p_nb_by_page,$page);

        /* création de l'affichage des résultats dans une chaine de caractere que l'on passera a la vue */

        $body = "<tbody id='table_donation_asso_by_member'>";


        foreach ($array['content'] as $key => $value) {

            $body .= '<tr role="row" class="odd">';

            foreach ($value as $k => $v) {
                if ($k == 3 && $v == 'OK') { $print_access = true; } else { $print_access = false;}
                $body .= '<td>'.$v.'</td>';
                // code...
            }

            $body .= '<td style = "width : 135px;">';
            $body .=    '<a style="margin-right:5px;" href="/www/Kalaweit/asso_donation_asso/update?don_id='.$value[0].'&from=get" class="btn btn-primary" id="update_'.$value[0].'"><i class="fa fa-edit"></i></a>';
            $body .=    '<a style="margin-right:5px;" href="/www/Kalaweit/asso_donation_asso/delete?don_id='.$value[0].'" class="btn btn-danger" id="delete_'.$value[0].'" onclick ="return confirm(\'Etes vous sur de vouloir supprimer cet enregistrement\')"><i class="fa  fa-trash"></i></a>';



            $name_receipt = (new \Kalaweit\Manager\Receipt($bdd))->name_receipt($value[0]);


            if($print_access == true){

                if( $name_receipt != NULL){

                    $body .=    '<a href="http://localhost:8888/Documents/receipt/'.$name_receipt["rec_number"].'.pdf" target="_blank" style="margin-right:5px;" class="btn btn-success" id="print_'.$value[0].'" ><i class="fa fa-print"></i></a>';

                } else {

                    $body .=    '<a href="/www/Kalaweit/receipt/add?don_id='.$value[0].'" target="_blank" style="margin-right:5px;" class="btn btn-warning" id="print_'.$value[0].'" ><i class="fa fa-print"></i></a>';
                }

            } else {

                $body .=    '<a href="#"  style="margin-right:5px;" class="btn btn-default" id="print_'.$value[0].'" disabled=disabled ><i class="fa fa-print"></i></a>';
            }
            $body .= '</td>';
            $body .= '</tr>';
        };

        $body .= '</tbody>';



        return $body;

    }

    function adhesion_by_member(){

        /* initialisation des variables */

        $p_nb_by_page = $_GET["nb_by_page"];
        $page = $_GET["p"];

        /* instanciation de la connexion a la bdd */

        $bddM = new \Kalaweit\Manager\Connexion();
        $bdd = $bddM->getBdd();

        /* récupération des données , retourne un tableau */

        $array = (new \Kalaweit\Manager\Asso_adhesion($bdd))->get_adhesion_by_member($p_nb_by_page,$page);

        /* création de l'affichage des résultats dans une chaine de caractere que l'on passera a la vue */

        $body = "<tbody id='table_adhesion_by_member'>";

        foreach ($array['content'] as $key => $value) {

            $body .= '<tr role="row" class="odd">';

            foreach ($value as $k => $v) {

                $body .= '<td>'.$v.'</td>';

                if ($k == 3 && $v == 'OK') { $print_access = true; } else { $print_access = false;}
                    // code...
                }

            $body .= '<td style = "width : 135px;">';
            $body .=    '<a style="margin-right:5px;" href="/www/Kalaweit/asso_adhesion/update?adhesion_id='.$value[0].'&from=get&cli_id='.$_GET["cli_id"].'" class="btn btn-primary" id="update_'.$value[0].'"><i class="fa fa-edit"></i></a>';
            $body .=    '<a style="margin-right:5px;" href="/www/Kalaweit/asso_adhesion/delete?adhesion_id='.$value[0].'" class="btn btn-danger" id="delete_'.$value[0].'" onclick ="return confirm(\'Etes vous sur de vouloir supprimer cet enregistrement\')"><i class="fa  fa-trash"></i></a>';


            $name_receipt = (new \Kalaweit\Manager\Receipt($bdd))->name_receipt_adhesion($value[0]);

            if($print_access == true){

                if( $name_receipt != NULL){

                    $body .=    '<a href="http://localhost:8888/Documents/receipt/'.$name_receipt["rec_number"].'.pdf" target="_blank" style="margin-right:5px;" class="btn btn-success" id="print_'.$value[0].'" ><i class="fa fa-print"></i></a>';

                } else {

                    $body .=    '<a href="/www/Kalaweit/receipt/add?adhesion_id='.$value[0].'" target="_blank" style="margin-right:5px;" class="btn btn-warning" id="print_'.$value[0].'" ><i class="fa fa-print"></i></a>';
                }

            } else {

                $body .=    '<a href="#"  style="margin-right:5px;" class="btn btn-default" id="print_'.$value[0].'" disabled=disabled ><i class="fa fa-print"></i></a>';
            }

            $body .= '</td>';

            $body .= '</tr>';
        };

        $body .= '</tbody>';

        return $body;

    }


    /**** méthode pour appeler une MAJ des dons foret par membre ****/

    function donation_forest_by_member(){

        /* initialisation des variables */

        $p_nb_by_page = $_GET["nb_by_page"];
        $page = $_GET["p"];

        /* instanciation de la connexion a la bdd */

        $bddM = new \Kalaweit\Manager\Connexion();
        $bdd = $bddM->getBdd();

        /* récupération des données , retourne un tableau */

        $array = (new \Kalaweit\Manager\Asso_donation_forest($bdd))->get_donation_forest_by_member($p_nb_by_page,$page);

        /* création de l'affichage des résultats dans une chaine de caractere que l'on passera a la vue */

        $body = "<tbody id='table_donation_forest_by_member'>";


        foreach ($array['content'] as $key => $value) {

            $body .= '<tr role="row" class="odd">';

            foreach ($value as $k => $v) {

                if ($k == 3 && $v == 'OK') { $print_access = 1; } else { $print_access = 0;}

                $body .= '<td>'.$v.'</td>';
                // code...
            }

            $body .= '<td style = "width : 135px;">';
            $body .=    '<a style="margin-right:5px;" href="/www/Kalaweit/asso_donation/update?don_id='.$value[0].'&from=get&cli_id='.$_GET["cli_id"].'" class="btn btn-primary" id="update_'.$value[0].'"><i class="fa fa-edit"></i></a>';
            $body .=    '<a style="margin-right:5px;" href="/www/Kalaweit/asso_donation/delete?don_id='.$value[0].'" class="btn btn-danger" id="delete_'.$value[0].'" onclick ="return confirm(\'Etes vous sur de vouloir supprimer cet enregistrement\')"><i class="fa  fa-trash"></i></a>';



            $name_receipt = (new \Kalaweit\Manager\Receipt($bdd))->name_receipt($value[0]);


            if($print_access == true){

                if( $name_receipt != NULL){

                    $body .=    '<a href="http://localhost:8888/Documents/receipt/'.$name_receipt["rec_number"].'.pdf" target="_blank" style="margin-right:5px;" class="btn btn-success" id="print_'.$value[0].'" ><i class="fa fa-print"></i></a>';

                } else {

                    $body .=    '<a href="/www/Kalaweit/receipt/add?don_id='.$value[0].'" target="_blank" style="margin-right:5px;" class="btn btn-warning" id="print_'.$value[0].'" ><i class="fa fa-print"></i></a>';
                }

            } else {

                $body .=    '<a href="#"  style="margin-right:5px;" class="btn btn-default" id="print_'.$value[0].'" disabled=disabled ><i class="fa fa-print"></i></a>';
            }

            $body .= '</td>';

            $body .= '</tr>';
        };

        $body .= '</tbody>';



        return $body;

    }

    /**** méthode pour appeler une MAJ des dons dulan par membre ****/

    function donation_dulan_by_member(){

        /* initialisation des variables */

        $p_nb_by_page = $_GET["nb_by_page"];
        $page = $_GET["p"];

        /* instanciation de la connexion a la bdd */

        $bddM = new \Kalaweit\Manager\Connexion();
        $bdd = $bddM->getBdd();

        /* récupération des données , retourne un tableau */

        $array = (new \Kalaweit\Manager\Asso_donation_dulan($bdd))->get_donation_dulan_by_member($p_nb_by_page,$page);

        /* création de l'affichage des résultats dans une chaine de caractere que l'on passera a la vue */

        $body = "<tbody id='table_donation_dulan_by_member'>";

        foreach ($array['content'] as $key => $value) {

            $body .= '<tr role="row" class="odd">';

            foreach ($value as $k => $v) {

                if ($k == 3 && $v == 'OK') { $print_access = true; } else { $print_access = false;}

                $body .= '<td>'.$v.'</td>';
            }

            $body .= '<td style = "width : 135px;">';
            $body .=    '<a style="margin-right:5px;" href="/www/Kalaweit/asso_donation/update?don_id='.$value[0].'&from=get&cli_id='.$_GET["cli_id"].'" class="btn btn-primary" id="update_'.$value[0].'"><i class="fa fa-edit"></i></a>';
            $body .=    '<a style="margin-right:5px;" href="/www/Kalaweit/asso_donation/delete?don_id='.$value[0].'" class="btn btn-danger" id="delete_'.$value[0].'" onclick ="return confirm(\'Etes vous sur de vouloir supprimer cet enregistrement\')"><i class="fa  fa-trash"></i></a>';



            $name_receipt = (new \Kalaweit\Manager\Receipt($bdd))->name_receipt($value[0]);


            if($print_access == true){

                if( $name_receipt != NULL){

                    $body .=    '<a href="http://localhost:8888/Documents/receipt/'.$name_receipt["rec_number"].'.pdf" target="_blank" style="margin-right:5px;" class="btn btn-success" id="print_'.$value[0].'" ><i class="fa fa-print"></i></a>';

                } else {

                    $body .=    '<a href="/www/Kalaweit/receipt/add?don_id='.$value[0].'" target="_blank" style="margin-right:5px;" class="btn btn-warning" id="print_'.$value[0].'" ><i class="fa fa-print"></i></a>';
                }

            } else {

                $body .=    '<a href="#"  style="margin-right:5px;" class="btn btn-default" id="print_'.$value[0].'" disabled=disabled ><i class="fa fa-print"></i></a>';
            }

            $body .= '</td>';

            $body .= '</tr>';
        };

        $body .= '</tbody>';



        return $body;

    }



    /************************************************************/
    /*                  MAJ des dons par cause                  */
    /************************************************************/

    function asso_cause_donation(){

        /* instanciation de la connexion a la bdd */

        $bddM = new \Kalaweit\Manager\Connexion();
        $bdd = $bddM->getBdd();

        /* initialisation des variables */

        $p_nb_by_page = $_GET["nb_by_page"];
        $page = $_GET["p"];

        /* récupération des données , retourne un tableau */

        $array = (new \Kalaweit\Manager\Asso_donation($bdd))->asso_cause_donation($p_nb_by_page,$page);

        /* création de l'affichage des résultats dans une chaine de caractere que l'on passera a la vue */

        $body = "<tbody id='table_asso_cause_donation'>";

        foreach ($array['content'] as $key => $value) {

            $body .= '<tr role="row" class="odd">';

            foreach ($value as $k => $v) {

                if ($k == 5 && $v == 'OK') { $print_access = true; } else { $print_access = false;}
                $body .= '<td>'.$v.'</td>';
                // code...
            }

            $body .= '<td style = "width:135px;">';
            $body .=    '<a style="margin-right:5px;" href="/www/Kalaweit/asso_donation/update?don_id='.$value[0].'" class="btn btn-primary" id="update_'.$value[0].'"><i class="fa fa-edit"></i></a>';
            $body .=    '<a style="margin-right:5px;" href="/www/Kalaweit/asso_donation/delete?don_id='.$value[0].'" class="btn btn-danger" id="delete_'.$value[0].'" onclick ="return confirm(\'Etes vous sur de vouloir supprimer cet enregistrement\')"><i class="fa  fa-trash"></i></a>';

            $name_receipt = (new \Kalaweit\Manager\Receipt($bdd))->name_receipt($value[0]);


            if($print_access == true){

                if( $name_receipt != NULL){

                    $body .=    '<a href="http://localhost:8888/Documents/receipt/'.$name_receipt["rec_number"].'.pdf" target="_blank" style="margin-right:5px;" class="btn btn-success" id="print_'.$value[0].'" ><i class="fa fa-print"></i></a>';

                } else {

                    $body .=    '<a href="/www/Kalaweit/receipt/add?don_id='.$value[0].'" target="_blank" style="margin-right:5px;" class="btn btn-warning" id="print_'.$value[0].'" ><i class="fa fa-print"></i></a>';
                }

            } else {

                $body .=    '<a href="#"  style="margin-right:5px;" class="btn btn-default" id="print_'.$value[0].'" disabled=disabled ><i class="fa fa-print"></i></a>';
            }

            $body .= '</td>';

            $body .= '</tr>';
        };

        $body .= '</tbody>';

        return $body;


    }

    /************************************************************/
    /*                  MAJ des avatars                         */
    /************************************************************/

    function upload_avatar(){

        if(isset($_POST["image"]))
        {
            $recup = $_POST["image"]; // image encodée en base 64;

            $image_array_1 = explode(";" , $recup);
            $image_array_2 = explode("," , $image_array_1[1]);

            $data = base64_decode($image_array_2[1]);
            $target_file = '/Documents/Avatar/Avatar'.$_GET['user_id'].'.png';
            $imageName = "..".$target_file;

            file_put_contents($imageName, $data);

            $bddM = new \Kalaweit\Manager\Connexion();
            $bdd = $bddM->getBdd();

            $reqprep = $bdd->prepare( " UPDATE sso_user SET user_avatar = '$target_file' WHERE user_id = :id");
            $prepare = [ ":id" => $_GET["user_id"]];

            $reqprep->execute($prepare);

        }
    }

    /************************************************************/
    /*                  MAJ des photos des causes               */
    /************************************************************/

    function upload_photo1(){

        /* vérification si element présent pour import */

        if(isset($_POST["image"]))
        {
            /* initialisation de la variable $recup avec une image dans le POST */

            $recup = $_POST["image"]; // image encodée en base 64;


            /* $recup sera de la forme :

            data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAwFBMVEXm7NK41k3w8fDv7+q01Tyy0zqv0DeqyjOszDWnxjClxC6iwCu11z6y1DvA2WbY4rCAmSXO3JZDTxOiwC3q7tyryzTs7uSqyi6tzTCmxSukwi9aaxkWGga+3FLv8Ozh6MTT36MrMwywyVBziSC01TbT5ZW9z3Xi6Mq2y2Xu8Oioxy7f572qxzvI33Tb6KvR35ilwTmvykiwzzvV36/G2IPw8O++02+btyepyDKvzzifvSmw0TmtzTbw8PAAAADx8fEC59dUAAAA50lEQVQYV13RaXPCIBAG4FiVqlhyX5o23vfVqUq6mvD//1XZJY5T9xPzzLuwgKXKslQvZSG+6UXgCnFePtBE7e/ivXP/nRvUUl7UqNclvO3rpLqofPDAD8xiu2pOntjamqRy/RqZxs81oeVzwpCwfyA8A+8mLKFku9XfI0YnSKXnSYZ7ahSII+AwrqoMmEFKriAeVrqGM4O4Z+ADZIhjg3R6LtMpWuW0ERs5zunKVHdnnnMLNQqaUS0kyKkjE1aE98b8y9x9JYHH8aZXFMKO6JFMEvhucj3Wj0kY2D92HlHbE/9Vk77mD6srRZqmVEAZAAAAAElFTkSuQmCC

            */

            /* traitement de la variable $recup pour récupération et creation du fichier image */

            $image_array_1 = explode(";" , $recup);
            $image_array_2 = explode("," , $image_array_1[1]);

            /* réencodage du fichier */

            $data = base64_decode($image_array_2[1]);

            /* définition du nom et du dossier de stockage du fichier */

            $target_file = '/Documents/Asso_cause/p1_'.$_GET['cau_id'].'.png';
            $imageName = "..".$target_file;

            /* création et enregistrement du fichier sur le serveur */

            file_put_contents($imageName, $data);

            /* instanciation de la connexion a la bdd */

            $bddM = new \Kalaweit\Manager\Connexion();
            $bdd = $bddM->getBdd();

            /* suppression de l'ancien chemin et écriture du nouveau chemin du fichier en bdd */

            $reqprep_delete = $bdd->prepare( "DELETE FROM asso_cause_media WHERE cau_id = :cau_id and caum_code = 'PHOTO1'");

            $reqprep_insert = $bdd->prepare(
                "INSERT INTO asso_cause_media (cau_id,caum_code,caum_type,caum_file,caum_lang)
                VALUES (:cau_id,'PHOTO1','PHOTO',:caum_file,'__')");

                $prepare_delete = [
                    ":cau_id" => $_GET["cau_id"],
                ];

                $prepare_insert = [
                    ":cau_id" => $_GET["cau_id"],
                    ":caum_file"=> 'p1_'.$_GET['cau_id'].'.png'
                ];

                $reqprep_delete->execute($prepare_delete);

                $reqprep_insert->execute($prepare_insert);

            }
        }

        function upload_photo2(){

            /* vérification si element présent pour import */

            if(isset($_POST["image"]))
            {
                /* initialisation de la variable $recup avec une image dans le POST */

                $recup = $_POST["image"]; // image encodée en base 64;

                /* $recup sera de la forme :

                data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAwFBMVEXm7NK41k3w8fDv7+q01Tyy0zqv0DeqyjOszDWnxjClxC6iwCu11z6y1DvA2WbY4rCAmSXO3JZDTxOiwC3q7tyryzTs7uSqyi6tzTCmxSukwi9aaxkWGga+3FLv8Ozh6MTT36MrMwywyVBziSC01TbT5ZW9z3Xi6Mq2y2Xu8Oioxy7f572qxzvI33Tb6KvR35ilwTmvykiwzzvV36/G2IPw8O++02+btyepyDKvzzifvSmw0TmtzTbw8PAAAADx8fEC59dUAAAA50lEQVQYV13RaXPCIBAG4FiVqlhyX5o23vfVqUq6mvD//1XZJY5T9xPzzLuwgKXKslQvZSG+6UXgCnFePtBE7e/ivXP/nRvUUl7UqNclvO3rpLqofPDAD8xiu2pOntjamqRy/RqZxs81oeVzwpCwfyA8A+8mLKFku9XfI0YnSKXnSYZ7ahSII+AwrqoMmEFKriAeVrqGM4O4Z+ADZIhjg3R6LtMpWuW0ERs5zunKVHdnnnMLNQqaUS0kyKkjE1aE98b8y9x9JYHH8aZXFMKO6JFMEvhucj3Wj0kY2D92HlHbE/9Vk77mD6srRZqmVEAZAAAAAElFTkSuQmCC

                */

                /* traitement de la variable $recup pour récupération et creation du fichier image */

                $image_array_1 = explode(";" , $recup);
                $image_array_2 = explode("," , $image_array_1[1]);

                /* réencodage du fichier */

                $data = base64_decode($image_array_2[1]);

                /* définition du nom et du dossier de stockage du fichier */

                $target_file = '/Documents/Asso_cause/p2_'.$_GET['cau_id'].'.png';
                $imageName = "..".$target_file;

                /* création et enregistrement du fichier sur le serveur */

                file_put_contents($imageName, $data);

                /* instanciation de la connexion a la bdd */

                $bddM = new \Kalaweit\Manager\Connexion();
                $bdd = $bddM->getBdd();

                /* suppression de l'ancien chemin et écriture du nouveau chemin du fichier en bdd */

                $reqprep_delete = $bdd->prepare( "DELETE FROM asso_cause_media WHERE cau_id = :cau_id and caum_code = 'PHOTO2'");

                $reqprep_insert = $bdd->prepare(
                    "INSERT INTO asso_cause_media (cau_id,caum_code,caum_type,caum_file,caum_lang)
                    VALUES (:cau_id,'PHOTO2','PHOTO',:caum_file,'__')");

                    $prepare_delete = [
                        ":cau_id" => $_GET["cau_id"],
                    ];

                    $prepare_insert = [
                        ":cau_id" => $_GET["cau_id"],
                        ":caum_file"=> 'p2_'.$_GET['cau_id'].'.png'
                    ];

                    $reqprep_delete->execute($prepare_delete);

                    $reqprep_insert->execute($prepare_insert);

                }
            }

        function export_excel(){

            $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();

            $url = explode('/export_excel/', $_SERVER["REQUEST_URI"]);
            $export = explode('?', $url[1]);

            $class = '\Kalaweit\Manager\\'.ucfirst($export[0]);

            $data = (new $class($bdd))->get_list_export();

            $p_tab = [
                "head"=>$data["head"],
                "content"=> $data["content"]
            ];

            (new \Kalaweit\Export\Export_Excel())->export_excel($p_tab);

        }


        }
