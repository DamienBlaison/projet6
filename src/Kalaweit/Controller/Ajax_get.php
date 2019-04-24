<?php
namespace Kalaweit\Controller;

/**
 *
 */
class Ajax_get
{
    function donation_animal_by_member(){

        $bddM = new \Kalaweit\Manager\Connexion();
        $bdd = $bddM->getBdd();

         $array = (new \Kalaweit\Manager\asso_donation($bdd))->get_donation_by_member();

         $body = "<tbody id='table_donation_animal_by_member'>";


         foreach ($array['list_donation'] as $key => $value) {

             $body .= '<tr role="row" class="odd">';

             foreach ($value as $k => $v) {

                 $body .= '<td>'.$v.'</td>';
                 // code...
             }

             $body .= '<td style = "width:85px;">';
             $body .=    '<a style="margin-right:5px;" href="http://localhost:8888/www/Kalaweit/asso_donation/update?don_id='.$value[0].'" class="btn btn-primary" id="update_'.$value[0].'" onclick ="return confirm(\'Etes vous sur de vouloir modifier cet enregistrement\')"><i class="fa fa-edit"></i></a>';
             $body .=    '<a href="http://localhost:8888/www/Kalaweit/asso_donation/delete?don_id='.$value[0].'" class="btn btn-danger" id="delete_'.$value[0].'" onclick ="return confirm(\'Etes vous sur de vouloir supprimer cet enregistrement\')"><i class="fa  fa-trash"></i></a>';
             $body .= '</td>';

             $body .= '</tr>';
         };

         $body .= '</tbody>';



         return $body;

    }

    function donation_forest_by_member(){

        $bddM = new \Kalaweit\Manager\Connexion();
        $bdd = $bddM->getBdd();

         $array = (new \Kalaweit\Manager\asso_donation_forest($bdd))->get_donation_forest_by_member();

         $body = "<tbody id='table_donation_forest_by_member'>";


         foreach ($array['list_donation_forest'] as $key => $value) {

             $body .= '<tr role="row" class="odd">';

             foreach ($value as $k => $v) {

                 $body .= '<td>'.$v.'</td>';
                 // code...
             }

             $body .= '<td style = "width:85px;">';
             $body .=    '<a style="margin-right:5px;" href="http://localhost:8888/www/Kalaweit/asso_donation/update?don_id='.$value[0].'" class="btn btn-primary" id="update_'.$value[0].'" onclick ="return confirm(\'Etes vous sur de vouloir modifier cet enregistrement\')"><i class="fa fa-edit"></i></a>';
             $body .=    '<a href="http://localhost:8888/www/Kalaweit/asso_donation/delete?don_id='.$value[0].'" class="btn btn-danger" id="delete_'.$value[0].'" onclick ="return confirm(\'Etes vous sur de vouloir supprimer cet enregistrement\')"><i class="fa  fa-trash"></i></a>';
             $body .= '</td>';

             $body .= '</tr>';
         };

         $body .= '</tbody>';



         return $body;

    }

    function donation_dulan_by_member(){

        $bddM = new \Kalaweit\Manager\Connexion();
        $bdd = $bddM->getBdd();

         $array = (new \Kalaweit\Manager\asso_donation_dulan($bdd))->get_donation_dulan_by_member();

         $body = "<tbody id='table_donation_forest_by_member'>";


         foreach ($array['list_donation_dulan'] as $key => $value) {

             $body .= '<tr role="row" class="odd">';

             foreach ($value as $k => $v) {

                 $body .= '<td>'.$v.'</td>';
                 // code...
             }

             $body .= '<td style = "width:85px;">';
             $body .=    '<a style="margin-right:5px;" href="http://localhost:8888/www/Kalaweit/asso_donation/update?don_id='.$value[0].'" class="btn btn-primary" id="update_'.$value[0].'" onclick ="return confirm(\'Etes vous sur de vouloir modifier cet enregistrement\')"><i class="fa fa-edit"></i></a>';
             $body .=    '<a href="http://localhost:8888/www/Kalaweit/asso_donation/delete?don_id='.$value[0].'" class="btn btn-danger" id="delete_'.$value[0].'" onclick ="return confirm(\'Etes vous sur de vouloir supprimer cet enregistrement\')"><i class="fa  fa-trash"></i></a>';
             $body .= '</td>';

             $body .= '</tr>';
         };

         $body .= '</tbody>';



         return $body;

    }


    function table_donator(){

        $bddM = new \Kalaweit\Manager\Connexion();
        $bdd = $bddM->getBdd();

         $array = (new \Kalaweit\Manager\asso_donation($bdd))->get_donation_by_member();

         $body = "<tbody id='donation_animal_by_member'>";


         foreach ($array['list_donation'] as $key => $value) {

             $body .= '<tr role="row" class="odd">';

             foreach ($value as $k => $v) {

                 $body .= '<td><a href="">'.$v.'</a></td>';
                 // code...
             }

             $body .= '<td style = "width:85px;">';
             $body .=    '<a style="margin-right:5px;" href="http://localhost:8888/www/Kalaweit/asso_donation/update?don_id='.$value[0].'" class="btn btn-primary" id="update_'.$value[0].'" onclick ="return confirm(\'Etes vous sur de vouloir modifier cet enregistrement\')"><i class="fa fa-edit"></i></a>';
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
}
