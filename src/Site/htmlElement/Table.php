<?php

namespace Site\htmlElement;
/**
 *
 */
class Table
{

    public function __construct(
        $p_data,
        $p_id,
        $p_print

        )

        {

        $this->data = $p_data;
        $this->id = $p_id;
        $this->print = $p_print;

        }

    // fonction pour afficher le contenu de la table avec une pagination en JS

    public function render(){


    // head du tableau

    $head = '';
    $head .= '<table class="table table-bordered table-striped dataTable" style:"text-align:cente;" role="grid" aria-describedby="table_info">';
    $head .= '<thead>';
    $head .= '<tr role="row">';

    for ($i = 0; $i < count($this->data['head']); $i++) {

        $head .= '<th class="" tabindex="'.$i.'" aria-controls="control'.$i.'" rowspan="1" colspan="1" aria-sort="ascending">'.$this->data['head'][$i].'</th>';
    };

    $head .= '</tr>';
    $head .= '</thead>';

    // body du tableau

    $body ='';

    $body .= '<tbody id="table_'.$this->id.'"style="text-align:center;">';

    foreach ($this->data['content'] as $key => $value) {

        $body .= '<tr role="row" class="odd">';

        foreach ($value as $k => $v) {


            $body .= '<td>'.$v.'</td>';

        }

        $body .= '<td style = "width : 135px;">';

        $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();


        $name_receipt = (new \Kalaweit\Manager\Receipt($bdd))->name_receipt($value[0]);

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


    // view

    $view =  $head.$body;

    return  $view;

    }

}
