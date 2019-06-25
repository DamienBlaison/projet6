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

                switch ($this->id) {
                    case 'donation_table':
                    $wait = $value[4];
                    $name_receipt = $value[2];


                    break;

                    case 'adhesion_table':
                    $wait = $value[4];
                    $name_receipt = $value[2];



                    break;

                    case 'donation_asso_table':
                    $wait = $value[4];


                    break;

                    case 'donation_dulan_table':
                    $wait = $value[3];



                    case 'donation_forest_table':
                    $wait = $value[3];
                    

                    break;

                    };


                    $body .= '<tr role="row" class="odd">';

                    foreach ($value as $k => $v) {


                        $body .= '<td>'.$v.'</td>';

                    }

                    $body .= '<td style = "width : 135px;">';

                    $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();

                //if( $name_receipt != NULL){

                if($wait == 'OK'){

                    $body .=    '<a href="http://localhost:8888/Documents/receipt/'.$name_receipt.'.pdf" target="_blank" style="margin-right:5px;" class="btn btn-success" id="print_'.$value[0].'" ><i class="fa fa-print"></i></a>';

                } else {

                    $body .=    '<btn style="margin-right:5px;" class="btn btn-warning" id="print_'.$value[0].' "><i class="fa fa-print"></i></button>';
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
