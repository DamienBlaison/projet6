<?php

namespace Kalaweit\htmlElement;
/**
 *
 */
class Table_without_pagination
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
    $from = $url["4"];



    // head du tableau

    $head = '';



    $head .= '<table id="table_'.$this->id.'" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="table_info">';
    $head .= '<thead>';
    $head .= '<tr role="row">';

    for ($i = 0; $i < count($this->data['head']); $i++) {

        if($i < 2){

            $head .= '<th style="display:none;" class="" tabindex="'.$i.'" aria-controls="control'.$i.'" rowspan="1" colspan="1" aria-sort="ascending">'.$this->data['head'][$i].'</th>';

        } else {

            $head .= '<th class="" tabindex="'.$i.'" aria-controls="control'.$i.'" rowspan="1" colspan="1" aria-sort="ascending">'.$this->data['head'][$i].'</th>';
        };

    };

    $head .= '</tr>';
    $head .= '</thead>';

    // body du tableau

    $body ='';

    $body .= "<tbody id='$this->id'>";

    foreach ($this->data['content'] as $key => $value) {

        $body .= '<tr role="row" class="odd">';

        foreach ($value as $k => $v) {

            if($k < 2)

            {
                $body .= '<td style = "display:none;">'.$v.'</a></td>';
            }

            else
            {
                $body .= '<td>'.$v.'</a></td>';
            }
        }

        $body .= '<td style = "width:85px;">';
        $body .=    '<a style="margin-right:5px;" href="'.$this->update.$value[0].'&from='.$from.'" class="btn btn-primary" id="update_'.$value[0].'"><i class="fa fa-edit"></i></a>';
        $body .=    '<a href="'.$this->delete.$value[0].'" class="btn btn-danger" id="delete_'.$value[0].'" onclick ="return confirm(\'Etes vous sur de vouloir supprimer cet enregistrement\')"><i class="fa  fa-trash"></i></a>';
        $body .= '</td>';

        $body .= '</tr>';
    };

    $body .= '</tbody>';
    $body .= '</table>';

    // view

    $view =  $head.$body;

    $box_table = (new \Kalaweit\htmlElement\Box($this->name,'box-primary',[$view],[12]))->render();

    return  $box_table;

    }

}
