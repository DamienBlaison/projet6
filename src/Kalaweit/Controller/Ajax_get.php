<?php
namespace Kalaweit\Controller;

/**
*
*/
class Ajax_get
{
    function donation_by_member(){

        $p_nb_by_page = $_GET["nb_by_page"];
        $page = $_GET["p"];

        $bddM = new \Kalaweit\Manager\Connexion();
        $bdd = $bddM->getBdd();

        $array = (new \Kalaweit\Manager\Asso_donation($bdd))->get_donation_by_member($p_nb_by_page,$page);

        $body = "<tbody id='table_donation_by_member'>";

        foreach ($array['content'] as $key => $value) {

            $body .= '<tr role="row" class="odd">';

            foreach ($value as $k => $v) {

                $body .= '<td>'.$v.'</td>';
                // code...
            }

            $body .= '<td style = "width:85px;">';
            $body .=    '<a style="margin-right:5px;" href="http://localhost:8888/www/Kalaweit/asso_donation/update?don_id='.$value[0].'" class="btn btn-primary" id="update_'.$value[0].'"><i class="fa fa-edit"></i></a>';
            $body .=    '<a href="http://localhost:8888/www/Kalaweit/asso_donation/delete?don_id='.$value[0].'" class="btn btn-danger" id="delete_'.$value[0].'" onclick ="return confirm(\'Etes vous sur de vouloir supprimer cet enregistrement\')"><i class="fa  fa-trash"></i></a>';
            $body .= '</td>';

            $body .= '</tr>';
        };

        $body .= '</tbody>';



        return $body;

    }

    function donation_forest_by_member(){

        $p_nb_by_page = $_GET["nb_by_page"];
        $page = $_GET["p"];

        $bddM = new \Kalaweit\Manager\Connexion();
        $bdd = $bddM->getBdd();

        $array = (new \Kalaweit\Manager\Asso_donation_forest($bdd))->get_donation_forest_by_member($p_nb_by_page,$page);

        $body = "<tbody id='table_donation_forest_by_member'>";


        foreach ($array['content'] as $key => $value) {

            $body .= '<tr role="row" class="odd">';

            foreach ($value as $k => $v) {

                $body .= '<td>'.$v.'</td>';
                // code...
            }

            $body .= '<td style = "width:85px;">';
            $body .=    '<a style="margin-right:5px;" href="http://localhost:8888/www/Kalaweit/asso_donation/update?don_id='.$value[0].'" class="btn btn-primary" id="update_'.$value[0].'"><i class="fa fa-edit"></i></a>';
            $body .=    '<a href="http://localhost:8888/www/Kalaweit/asso_donation/delete?don_id='.$value[0].'" class="btn btn-danger" id="delete_'.$value[0].'" onclick ="return confirm(\'Etes vous sur de vouloir supprimer cet enregistrement\')"><i class="fa  fa-trash"></i></a>';
            $body .= '</td>';

            $body .= '</tr>';
        };

        $body .= '</tbody>';



        return $body;

    }

    function donation_dulan_by_member(){

        $p_nb_by_page = $_GET["nb_by_page"];
        $page = $_GET["p"];

        $bddM = new \Kalaweit\Manager\Connexion();
        $bdd = $bddM->getBdd();

        $array = (new \Kalaweit\Manager\Asso_donation_dulan($bdd))->get_donation_dulan_by_member($p_nb_by_page,$page);

        $body = "<tbody id='table_donation_dulan_by_member'>";


        foreach ($array['content'] as $key => $value) {

            $body .= '<tr role="row" class="odd">';

            foreach ($value as $k => $v) {

                $body .= '<td>'.$v.'</td>';
                // code...
            }

            $body .= '<td style = "width:85px;">';
            $body .=    '<a style="margin-right:5px;" href="http://localhost:8888/www/Kalaweit/asso_donation/update?don_id='.$value[0].'" class="btn btn-primary" id="update_'.$value[0].'"><i class="fa fa-edit"></i></a>';
            $body .=    '<a href="http://localhost:8888/www/Kalaweit/asso_donation/delete?don_id='.$value[0].'" class="btn btn-danger" id="delete_'.$value[0].'" onclick ="return confirm(\'Etes vous sur de vouloir supprimer cet enregistrement\')"><i class="fa  fa-trash"></i></a>';
            $body .= '</td>';

            $body .= '</tr>';
        };

        $body .= '</tbody>';



        return $body;

    }


    function donations_animal($year){

        $bddM = new \Kalaweit\Manager\Connexion();
        $bdd = $bddM->getBdd();

        $data = (new \Kalaweit\Manager\asso_donation($bdd))->get_chart($year,$cause_type);

        return $data;

    }

    function asso_cause_donation(){

        $bddM = new \Kalaweit\Manager\Connexion();
        $bdd = $bddM->getBdd();

        $p_nb_by_page = $_GET["nb_by_page"];
        $page = $_GET["p"];

        $array = (new \Kalaweit\Manager\Asso_donation($bdd))->asso_cause_donation($p_nb_by_page,$page);

        $body = "<tbody id='table_asso_cause_donation'>";

        foreach ($array['content'] as $key => $value) {

            $body .= '<tr role="row" class="odd">';

            foreach ($value as $k => $v) {

                $body .= '<td>'.$v.'</td>';
                // code...
            }

            $body .= '<td style = "width:85px;">';
            $body .=    '<a style="margin-right:5px;" href="http://localhost:8888/www/Kalaweit/asso_donation/update?don_id='.$value[0].'" class="btn btn-primary" id="update_'.$value[0].'"><i class="fa fa-edit"></i></a>';
            $body .=    '<a href="http://localhost:8888/www/Kalaweit/asso_donation/delete?don_id='.$value[0].'" class="btn btn-danger" id="delete_'.$value[0].'" onclick ="return confirm(\'Etes vous sur de vouloir supprimer cet enregistrement\')"><i class="fa  fa-trash"></i></a>';
            $body .= '</td>';

            $body .= '</tr>';
        };

        $body .= '</tbody>';

        return $body;


    }

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
    function upload_photo1(){

        if(isset($_POST["image"]))
        {

            $recup = $_POST["image"]; // image encodée en base 64;

            $image_array_1 = explode(";" , $recup);
            $image_array_2 = explode("," , $image_array_1[1]);

            $data = base64_decode($image_array_2[1]);
            $target_file = '/Documents/Asso_cause/p1_'.$_GET['cau_id'].'.png';
            $imageName = "..".$target_file;

            file_put_contents($imageName, $data);

            $bddM = new \Kalaweit\Manager\Connexion();
            $bdd = $bddM->getBdd();

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

        if(isset($_POST["image"]))
        {

            $recup = $_POST["image"]; // image encodée en base 64;

            $image_array_1 = explode(";" , $recup);
            $image_array_2 = explode("," , $image_array_1[1]);

            $data = base64_decode($image_array_2[1]);
            $target_file = '/Documents/Asso_cause/p2_'.$_GET['cau_id'].'.png';
            $imageName = "..".$target_file;

            file_put_contents($imageName, $data);

            $bddM = new \Kalaweit\Manager\Connexion();
            $bdd = $bddM->getBdd();

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

}
