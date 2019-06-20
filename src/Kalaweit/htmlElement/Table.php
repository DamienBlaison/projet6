<?php

namespace Kalaweit\htmlElement;
/**
 *
 */
class Table
{

    public function __construct(
        $p_name,
        $p_data,
        $p_id,
        $p_update,
        $p_delete,
        $p_print,
        $p_add,
        $p_n_page

        )

        {

        $this->name = $p_name;
        $this->data = $p_data;
        $this->id = $p_id;
        $this->update = $p_update;
        $this->delete = $p_delete;
        $this->print = $p_print;
        $this->add = $p_add;
        $this->n_page = $p_n_page;

        }

    // fonction pour afficher le contenu de la table avec une pagination en JS

    public function render(){

    if ($this->n_page == 0) { $this->n_page = 1;};

    $url = explode("/",$_SERVER['REQUEST_URI']);
    $temp = $url["4"];
    $from = explode("?",$temp);
    $from = $from[0];

    // head du tableau

    $head = '';



    $head .= '<table class="table table-bordered table-striped dataTable" role="grid" aria-describedby="table_info">';
    $head .= '<thead>';
    $head .= '<tr role="row">';

    for ($i = 0; $i < count($this->data['head']); $i++) {

        $head .= '<th class="" tabindex="'.$i.'" aria-controls="control'.$i.'" rowspan="1" colspan="1" aria-sort="ascending">'.$this->data['head'][$i].'</th>';
    };

    $head .= '</tr>';
    $head .= '</thead>';

    // body du tableau

    $body ='';

    $body .= '<tbody id="table_'.$this->id.'">';

    foreach ($this->data['content'] as $key => $value) {

        $body .= '<tr role="row" class="odd">';

        foreach ($value as $k => $v) {


            $body .= '<td>'.$v.'</td>';

        }



        $body .= '<td style = "width : 135px;">';
        $body .=    '<a style="margin-right:5px;" href="/'.$this->update.$value[0].'&from='.$from.'" class="btn btn-primary" id="update_'.$value[0].'"><i class="fa fa-edit"></i></a>';
        $body .=    '<a style="margin-right:5px;"href="/'.$this->delete.$value[0].'" class="btn btn-danger" id="delete_'.$value[0].'" onclick ="return confirm(\'Etes vous sur de vouloir supprimer cet enregistrement\')"><i class="fa  fa-trash"></i></a>';

        $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();

        if($this->id == "adhesion_by_member"){

            $name_receipt = (new \Kalaweit\Manager\Receipt($bdd))->name_receipt_adhesion($value[0]);

        } else {

            $name_receipt = (new \Kalaweit\Manager\Receipt($bdd))->name_receipt($value[0]);

        }



        if( $name_receipt != NULL){

            $body .=    '<a href="http://localhost:8888/Documents/receipt/'.$name_receipt["rec_number"].'.pdf" target="_blank" style="margin-right:5px;" class="btn btn-success" id="print_'.$value[0].'" ><i class="fa fa-print"></i></a>';

        } else {

            $body .=    '<a href="/'.$this->print.$value[0].'" target="_blank" style="margin-right:5px;" class="btn btn-warning" id="print_'.$value[0].'" ><i class="fa fa-print"></i></a>';
        }



        //$body .=    '<a href="/'.$this->print.$value[0].'" class="btn btn-primary" id="print_'.$value[0].'"><i class="fa fa-print"></i></a>';
        $body .= '</td>';

        $body .= '</tr>';
    };

    $body .= '</tbody>';
    $body .= '</table>';

    //pagination

    $pagination  = '';

    $pagination .='<div>';

    $pagination .=   '<div id="nav_'.$this->id.'" style="display:flex;justify-content:space-between;">';
    $pagination .=       '<ul class="pagination">';
    $pagination .=            '<li class="page-item " id="previous_'.$this->id.'"><a class="page-link" >Previous</a></li>';
    $pagination .=            '<li class="page-item" id="ad_'.$this->id.'"><a class="page-link" href="/'.$this->add.'"><i class="fa fa-plus"></i></a></li>';
    $pagination .=            '<li class="page-item" id="next_'.$this->id.'"><a class="page-link" >Next</a></li>';
    $pagination .=        '</ul>';

    $pagination .=              '<ul class="pagination">';
    $pagination .=                  '<li class="page-item"><a class="page-link">Page </a></li>';
    $pagination .=                  '<li class="page-item"><a class="page-link" id="current_'.$this->id.'">1</a></li>';
    $pagination .=                  '<li class="page-item"><a class="page-link">/</a></li>';
    $pagination .=                  '<li class="page-item"><a class="page-link" id="nb_'.$this->id.'">'.ceil(intval($this->data["count"]) / (intval($this->n_page))).'</a></li>';
    $pagination .=              '</ul>';

    $pagination .=              '<ul class="pagination">';
    $pagination .=                  '<li class="page-item"><a class="page-link">Nombre de resultat :  </a></li>';
    $pagination .=                  '<li class="page-item"><a class="page-link" id= "nb_page_'.$this->id.'" >'.$this->data["count"].'</a></li>';
    $pagination .=              '</ul>';

    //pagination .=              '<ul class="pagination">';
    //$pagination .=                  '<li class="page-item" id="export_table_'.$this->id.'"><a class="page-link">export excel  </a></li>';
    //$pagination .=              '</ul>';


    $pagination .=     '</div>';

    $pagination .=' </div>';

    // view

    $view =  $head.$body.$pagination;

    $box_table = (new \Kalaweit\htmlElement\Box($this->name,'box-primary',[$view],[12]))->render();

    return  $box_table;

    }

}
