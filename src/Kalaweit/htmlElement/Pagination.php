<?php
namespace Kalaweit\htmlElement;

/**
*
*/
class Pagination
{

    function render($count_pages){

        $url  = explode('?',$_SERVER['REQUEST_URI']);
        $road_function = explode('/',$url[0]);

        if ($road_function[4] == 'list')

        {

            if(isset($url[1])){
                $input = $url[1];
            }

            $current_page = intval(array_pop($road_function));

            $url_current = '';

            foreach ($road_function as $key => $value) {

                $url_current .= $value.'/';// code...
            }

            if (isset($input) && $input != NULL){
                $next = $url_current.($current_page+1).'?'.$input;
                $previous = $url_current.($current_page-1).'?'.$input;

            } else {
                $next = $url_current.($current_page+1);
                $previous = $url_current.($current_page-1);

            };

        }

        if($current_page < 2){

            $previous_disabled  = "disabled";
            $previous           = " ";

        } else {

            $previous_disabled  = " ";

        };

        if((ceil($count_pages/15) - $current_page) > 0){

            $next_disabled      = " ";

        } else {
            $next_disabled      = "disabled";
            $next               = " ";

        };

        $view = '';

        $view .='     <div class="container-fluid">';
        $view  .='         <div class="col-sm-9">';
        $view  .='             <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">';
        $view  .='                 <ul class="pagination">';
        $view  .='                     <li class="paginate_button previous '.$previous_disabled.'" id="previous"><a href="'.$previous.'" aria-controls="example11" data-dt-idx="1" tabindex="11">Précédent</a></li>';
        $view  .='                     <li class="paginate_button" aria-controls= "example2" data-dt-idx="1" tabindex="2"><a href="#" >'.$current_page.'</a></li>';
        $view  .='                     <li class="paginate_button next '.$next_disabled.'" id="next"><a href="'.$next.'" aria-controls="example11" data-dt-idx="1" tabindex="11">Next</a></li>';
        $view  .='                 </ul>';
        $view  .='             </div>';
        $view  .='         </div>';
        $view  .='         <div class="col-sm-3">';
        $view  .='             <div class="dataTables_paginate paging_simple_numbers" id="paginate2">';
        $view  .='                 <ul class="pagination">';
        $view  .='                     <li class="paginate_button">';

        if (isset($count_pages))

        {
            $view  .= 'Nombre de résultats : '.$count_pages.' - Page '.$current_page.'/'.ceil($count_pages/15) ;
        }

        $view  .='                     </li>';
        $view  .='                </ul>';
        $view  .='            </div>';
        $view  .='        </div>';
        $view  .='    </div>';

        return $view ;

    }
}
