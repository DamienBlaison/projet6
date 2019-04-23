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
        $p_link,
        $p_update,
        $p_delete,
        $p_add


        )

        {

        $this->name = $p_name;
        $this->data = $p_data;
        $this->id = $p_id;
        $this->link = $p_link;
        $this->update = $p_update;
        $this->delete = $p_delete;
        $this->add = $p_add;


        }

    // fonction pour afficher le contenu de la table avec une pagination en JS

    public function render(){

    $url = explode("/",$_SERVER['REQUEST_URI']);
    $temp = $url["4"];
    $from = explode("?",$temp);
    $from = $from[0];


    // head du tableau

    $head = '';



    $head .= '<table id="table_'.$this->id.'" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="table_info">';
    $head .= '<thead>';
    $head .= '<tr role="row">';

    for ($i = 0; $i < count($this->data['head']); $i++) {

        $head .= '<th class="" tabindex="'.$i.'" aria-controls="control'.$i.'" rowspan="1" colspan="1" aria-sort="ascending">'.$this->data['head'][$i].'</th>';
    };

    $head .= '</tr>';
    $head .= '</thead>';

    // body du tableau

    $body ='';

    $body .= "<tbody id='$this->id'>";

    foreach ($this->data['content'] as $key => $value) {

        $body .= '<tr role="row" class="odd">';

        foreach ($value as $k => $v) {

            //$body .= '<td><a href="'.$this->link.$value[1].'">'.$v.'</a></td>';
            $body .= '<td>'.$v.'</td>';
            // code...
        }

        $body .= '<td style = "width:85px;">';
        $body .=    '<a style="margin-right:5px;" href="'.$this->update.$value[0].'&from='.$from.'" class="btn btn-primary" id="update_'.$value[0].'" onclick ="return confirm(\'Etes vous sur de vouloir modifier cet enregistrement\')"><i class="fa fa-edit"></i></a>';
        $body .=    '<a href="'.$this->delete.$value[0].'" class="btn btn-danger" id="delete_'.$value[0].'" onclick ="return confirm(\'Etes vous sur de vouloir supprimer cet enregistrement\')"><i class="fa  fa-trash"></i></a>';
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
    $pagination .=            '<li class="page-item disabled" id="previous_'.$this->id.'"><a class="page-link" >Previous</a></li>';
    $pagination .=            '<li class="page-item" id="ad_'.$this->id.'"><a class="page-link" href="'.$this->add.'"><i class="fa fa-plus"></i></a></li>';
    $pagination .=            '<li class="page-item" id="next_'.$this->id.'"><a class="page-link" >Next</a></li>';
    $pagination .=        '</ul>';

    $pagination .=              '<ul class="pagination">';
    $pagination .=                  '<li class="page-item"><a class="page-link">Page </a></li>';
    $pagination .=                  '<li class="page-item"><a class="page-link" id="current_'.$this->id.'">1</a></li>';
    $pagination .=                  '<li class="page-item"><a class="page-link">/</a></li>';
    $pagination .=                  '<li class="page-item"><a class="page-link">'.ceil(intval($this->data["count"]) / 5).'</a></li>';
    $pagination .=              '</ul>';

    $pagination .=              '<ul class="pagination">';
    $pagination .=                  '<li class="page-item"><a class="page-link">Nombre de resultat :  </a></li>';
    $pagination .=                  '<li class="page-item"><a class="page-link" >'.$this->data["count"].'</a></li>';
    $pagination .=              '</ul>';
    $pagination .=     '</div>';

    $pagination .=' </div>';

    // view

    $view =  $head.$body.$pagination;

    $box_table = (new \Kalaweit\htmlElement\Box($this->name,'box-primary',[$view],[12]))->render();

    return  $box_table;

    }

}
