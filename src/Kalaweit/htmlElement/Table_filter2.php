<?php

namespace Kalaweit\htmlElement;

class Table_filter

{

    public function render($fields,$data){

        //($fields,$data);

        $url  = explode('?',$_SERVER['REQUEST_URI']);

        if(isset($url[1])){$input = $url[1];}
        $road_function = explode('/',$url[0]);

        $pagination = intval(array_pop($road_function));

        $url_current = '';

        foreach ($road_function as $key => $value) {
            $url_current .= $value.'/';
        }

        $pagination = (new \Kalaweit\htmlElement\pagination)->render($data['count']);
        //$pagination = (new \Kalaweit\htmlElement\Multi_pagination)->render($data['count'],'don1');

        $init = explode('?',$_SERVER['REQUEST_URI']);

        // $ fields =[
        //  ["type_balise","Id","type","name","v","placeholder","class"],[]
        // ]

        $header = '<div class="container-fluid">';
        //$header .='<div class="content-header">';
        //$header .=      '<section class="content">';
        $header .=          '<div class="box box-primary collapsed-box">';
        $header .=              '<div class="box-header with-border">';
        $header .=                  '<h3 class="box-title">Filtres</h3>';
        $header .=                  '<div class="pull-right box-tools">';
        $header .=                      '<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>';
        $header .=                  '</div>';
        $header .=              '</div>';
        $header .=              '<form class="box-body container-fluid d-flex align-items-end row" method="" action="'.substr($url_current, 0, -1).'/1'.'"></br>';
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
        $content .=                     '<h3 class="box-title">Résultats</h3>';
        $content .=                 '</div>';

        $table  = '<table class="table table-bordered table-striped dataTable" role="grid" aria-describedby="table_info">';
        $table .= '<thead>';
        $table .= '<tr role="row">';

        foreach ($data["head"] as $key => $value) {

            $table .= '<th class="" tabindex="'.$key.'" aria-controls="control'.$key.'" rowspan="1" colspan="1" aria-sort="ascending">'.$value.'</th>';
        };

        $table.= '</tr>';
        $table .= '</thead>';
        $table .= '<tbody>';

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
                break;
        }





            foreach ($data["table"] as $d_k => $d_v) {

                $table .= '<tr role="row" class="odd">';

                foreach ($d_v as $key => $value) {

                    if ($url[3] == 'asso_donation') {

                        $table .= '<td><a href='.$link.$d_v[1].'>'.$value.'</a></td>';
                    }
                    else{
                        $table .= '<td><a href='.$link.$d_v[0].'>'.$value.'</a></td>';
                    }





                }

                $table .= '<td style = "width:85px;">';
                $table .=    '<a style="margin-right:5px;" href="'.$update.$d_v[0].'" class="btn btn-primary" id="update_'.$d_v[0].'" onclick ="return confirm(\'Etes vous sur de vouloir modifier cet enregistrement\')"><i class="fa fa-edit"></i></a>';
                $table .=    '<a href="'.$delete.$d_v[0].'" class="btn btn-danger" id="delete_'.$d_v[0].'" onclick ="return confirm(\'Etes vous sur de vouloir supprimer cet enregistrement\')"><i class="fa  fa-trash"></i></a>';
                $table .= '</td>';

                $table .= '</tr>';


            };
        $table .= '</tbody>';
        $table .= '</table>';

        $content .= $table;

        //$content .=     '</section>';
        //$content .=    '</div>';

        $content .= $pagination;
        $content .=  '</div>';
        $content .=  '</div>';




        $result = $header.$content;

        return $result;

    }
}
