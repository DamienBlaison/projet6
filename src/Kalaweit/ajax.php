<?php
namespace Kalaweit;

/**
*
*/
class ajax
{
    use \Kalaweit\Transverse\Get_param_request;

    private $bdd;

    /**
    * définition du constructeur
    */

    function __construct($bdd)
    {
        $this->bdd = $bdd;

    }

    function get_members(){

        $link   = 'http://localhost:8888/www/Kalaweit/member/get?cli_id=';
        $update = 'http://localhost:8888/www/Kalaweit/member/get?cli_id=';
        $delete = 'http://localhost:8888/www/Kalaweit/member/delete?cli_id=';


        $return = (new \Kalaweit\manager\Member($this->bdd))->get_list();


        $table = '<tbody id="list_member_filtered>"';

        foreach ($return['list_member'] as $d_k => $d_v) {

            $table .= '<tr role="row" class="odd">';

            foreach ($d_v as $key => $value) {

                $table .= '<td><a href='.$link.$d_v[0].'>'.$value.'</a></td>';
            }

        $table .= '<td style = "width:85px;">';
        $table .=    '<a style="margin-right:5px;" href="'.$update.$d_v[0].'" class="btn btn-primary" id="update_'.$d_v[0].'" onclick ="return confirm(\'Etes vous sur de vouloir modifier cet enregistrement\')"><i class="fa fa-edit"></i></a>';
        $table .=    '<a href="'.$delete.$d_v[0].'" class="btn btn-danger" id="delete_'.$d_v[0].'" onclick ="return confirm(\'Etes vous sur de vouloir supprimer cet enregistrement\')"><i class="fa  fa-trash"></i></a>';
        $table .= '</td>';

        $table .= '</tr>';

        }

        $table .= '</tbody>';

        return $table;
    }
}
