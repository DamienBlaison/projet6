<?php

namespace Kalaweit\htmlElement;

class Table_filter

{

    public function render($fields,$data){

        $url  = explode('?',$_SERVER['REQUEST_URI']);

        $url_current = explode('/',$url["0"]);
        $controller =  $url_current[3];
        $page_current = array_pop($url_current);

        $controller =

        $url_next_previous = '';

        foreach ($url_current as $key => $value) {

            $url_next_previous .= $value.'/';
            // code...
        }

        $recup_get = '';

        foreach ($_GET as $key => $value) {

            $recup_get .= $key.'='.$value.'&';
            // code...
        }

        if(isset($url[1])){$param = '?'.$url[1];} else { $param = '';};

        $url_next = $url_next_previous . ($page_current+1).$param;
        $url_previous = $url_next_previous . ($page_current-1).$param;
        $url = $url_next_previous. $page_current;

        $action = $url_next_previous.'1';

        $init = explode('?',$_SERVER['REQUEST_URI']);

        $header = '<div class="container-fluid">';

        $header .=          '<div class="box box-primary collapsed-box">';
        $header .=              '<div class="box-header with-border">';
        $header .=                  '<h3 class="box-title">Filtres</h3>';
        $header .=                  '<div class="pull-right box-tools">';
        $header .=                      '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>';
        $header .=                  '</div>';
        $header .=              '</div>';
        $header .=              '<form class="box-body container-fluid d-flex align-items-end row" method="" action="'.$action.'"></br>';
        $header .=                  '<div class="col-md-12">';


        foreach ($fields as $k => $v) {


            $header .=                      '<div class="form-group col-md-'.$v["class"].'">';
            $header .=                           '<!--<label for="'.$v['id'].'">Id</label>-->';
            $header .=                           '<'.$v['type_balise'].' placeholder="'.$v["placeholder"].'" class="form-control" type="'.$v["type"].'" name="'.$v["name"].'" value="'.$v["value"].'" id="'.$v["id"].'">';
            $header .=                      '</div>';

        };

        $header .=                      '<div class="form-group col-md-1">';
        $header .=                          '<!--<label style="color:white;" for="submit"> test</label>-->';
        $header .=                          '<button id="submit" type="submit" class="form-control btn btn-primary"><i class="fa fa-search"></i></button>';
        $header .=                      '</div>';
        $header .=                      '<div class="form-group col-md-1">';
        $header .=                          '<!--<label style="color:white;" for="reset"> test</label>-->';
        $header .=                          '<a id="reset" class="form-control btn btn-danger" href="'.$init[0].'"><i class="fa fa-minus"></i></a>';
        $header .=                      '</div>';
        $header .=                  '</div>';

        $header .=              '</form>';
        $header .=            '</div>';
        $header .=            '</div>';

        $content  = '<div class="container-fluid">';
        $content .=             '<div class="box box-primary">';
        $content .=                 '<div class="box-header with-border">';
        $content .=                     '<h3 class="box-title">'.$data["title"].'</h3>';
        $content .=                 '</div>';

        $table  = '<table class="table table-bordered table-striped dataTable" role="grid" aria-describedby="table_info">';
        $table .= '<thead>';
        $table .= '<tr role="row">';

        foreach ($data["head"] as $key => $value) {

            if($key < 1)
            {
                $table .= '<th style="display:none;" tabindex="'.$key.'" aria-controls="control'.$key.'" rowspan="1" colspan="1" aria-sort="ascending">'.$value.'</th>';
            }

            else
            {
                $table .= '<th tabindex="'.$key.'" aria-controls="control'.$key.'" rowspan="1" colspan="1" aria-sort="ascending">'.$value.'</th>';}
            ;
        };

        $table .= '<th class="" style="text-align:center;">Action</th>';
        $table.= '</tr>';
        $table .= '</thead>';


        $url = explode('/',$_SERVER['REQUEST_URI']);

        switch ($url['3']) {
            case 'member':
            $key = 'cli_id';
            $link = 'http://localhost:8888/www/Kalaweit/'.$url['3'].'/get?'.$key.'=';
            $update = 'http://localhost:8888/www/Kalaweit/member/get?cli_id=';
            $delete = 'http://localhost:8888/www/Kalaweit/member/delete?cli_id=';




            break;
            case 'asso_cause':
            $key = 'cau_id';
            $link = 'http://localhost:8888/www/Kalaweit/'.$url['3'].'/get?'.$key.'=';
            $update = 'http://localhost:8888/www/Kalaweit/asso_cause/get?cau_id=';
            $delete = 'http://localhost:8888/www/Kalaweit/asso_cause/delete?cau_id=';


            break;
            case 'asso_donation':
            $key = 'cli_id';
            $link = 'http://localhost:8888/www/Kalaweit/member/get?cli_id=';
            $update = 'http://localhost:8888/www/Kalaweit/asso_donation/update?don_id=';
            $delete = 'http://localhost:8888/www/Kalaweit/asso_donation/delete?don_id=';
            $print = 'http://localhost:8888/www/Kalaweit/receipt/get/?receipt_id=';
            break;

            case 'asso_adhesion':
            $key = 'cli_id';
            $link = 'http://localhost:8888/www/Kalaweit/member/get?cli_id=';
            $update = 'http://localhost:8888/www/Kalaweit/asso_adhesion/update?adhesion_id=';
            $delete = 'http://localhost:8888/www/Kalaweit/asso_adhesion/delete?adhesion_id=';
            $print = 'http://localhost:8888/www/Kalaweit/receipt/get/?receipt_id=';
            break;
            case 'asso_donation_forest':
            $key = 'cli_id';
            $link = 'http://localhost:8888/www/Kalaweit/member/get?cli_id=';
            $update = 'http://localhost:8888/www/Kalaweit/asso_donation_forest/update?donation_forest_id=';
            $delete = 'http://localhost:8888/www/Kalaweit/asso_donation_forest/delete?donation_forest_id=';
            $print = 'http://localhost:8888/www/Kalaweit/receipt/get/?receipt_id=';

            break;
            case 'asso_donation_dulan':
            $key = 'cli_id';
            $link = 'http://localhost:8888/www/Kalaweit/member/get?cli_id=';
            $update = 'http://localhost:8888/www/Kalaweit/asso_donation_dulan/update?donation_dulan_id=';
            $delete = 'http://localhost:8888/www/Kalaweit/asso_donation_dulan/delete?donation_dulan_id=';
            $print = 'http://localhost:8888/www/Kalaweit/receipt/get/?receipt_id=';
            break;

            case 'users':
            $key = 'user_id';
            $link = '';
            $update = 'http://localhost:8888/www/Kalaweit/users/update?user_id=';
            $delete = 'http://localhost:8888/www/Kalaweit/users/delete?user_id=';
            break;
        }

        $table .= '<tbody id="table">';

        foreach ($data["table"] as $d_k => $d_v) {

            $table .= '<tr role="row" class="odd">';

            if ($url[3] == 'asso_donation' || $url[3] == 'asso_donation_dulan' || $url[3] == 'asso_donation_forest') {

                $receipt = array_pop($d_v);
            };

            foreach ($d_v as $key => $value) {

                if($key < 1){
                    $table .= '<td style = " display:none;">'.$value.'</td>';
                }else{
                    $table .= '<td>'.$value.'</td>';
                }


            }

            $table .= '<td style = "width:140px; text-align:center;">';
            $table .=    '<a style="margin-right:5px;" href="'.$update.$d_v[0].'" class="btn btn-primary" id="update_'.$d_v[0].'"><i class="fa fa-edit"></i></a>';

            $table .=    '<a style="margin-right:5px;" href="'.$delete.$d_v[0].'" class="btn btn-danger" id="delete_'.$d_v[0].'" onclick ="return confirm(\'Etes vous sur de vouloir supprimer cet enregistrement? \')"><i class="fa  fa-trash"></i></a>';


            if($url[3] == 'asso_donation' || $url[3] == 'asso_donation_dulan' || $url[3] == 'asso_donation_forest' ){

                $file = $receipt.'.pdf';

                if (file_exists('../Documents/Receipt/'.$file)){

                    $table .=    '<a href="http://localhost:8888/Documents/Receipt/'.$file.'" target="_blank" style="margin-right:5px;" class="btn btn-success" id="print_'.$d_v[0].'" ><i class="fa fa-print"></i></a>';

                } else {

                    $table .=    '<a href="" style="margin-right:5px;" class="btn btn-warning" id="print_'.$d_v[0].'" ><i class="fa fa-print"></i></a>';
                }

            }



            $table .= '</td>';

            $table .= '</tr>';


        };

        $table .= '</tbody>';


        $table .= '</table>';
        $table .= '</div>';


        $content .= $table;

        $content .='<div class="container-fluid">';
        $content .=   '<div id="nav1"aria-label="Page navigation example" class="col-sm-4">';
        $content .=       '<ul class="pagination">';
        $content .=            '<li class="page-item disabled" id="previous_member"><a href = " '.$url_previous.'" class="page-link" >Previous</a></li>';
        $content .=            '<li class="page-item"><a class="page-link" id="current_member">'.$page_current.'</a></li>';
        $content .=            '<li class="page-item" id="next_member"><a href = " '.$url_next.'" class="page-link" >Next</a></li>';
        $content .=        '</ul>';
        $content .=    '</div>';
        $content .=    '<div class="col-sm-5" style="margin-top: 30px;">';
        $content .=         'Nombre de résultats : '.$data["count"].' soit '.ceil($data["count"]/10).' pages';
        $content .=   '</div>';
        $content .=    '<div class="col-sm-3 " style="margin-top: 30px;">';
        $content .=    '<button id="export_table_'.$url[3].'" class="btn btn-success pull-right fa fa-bar-chart" style="margin-top:-10px;"> <b> Export Excel</button></b>';
        $content .=    '</div>';
        $content .=    '</div>';
        $content .=' </div>';
        $content .=  '</div>';
        $content .=  '</div>';

        $result = $header.$content;

        return  $result;

    }
}
