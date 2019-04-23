<?php
namespace Kalaweit\htmlElement;

/**
*
*/
class Multi_pagination
{

    function render($count_result,$param_get){


        $current_url = $_SERVER['REQUEST_URI'];

            $param_pagination = explode("&",$current_url);
            $url = array_shift($param_pagination);

            $next       = $url.'&';
            $previous   = $url.'&';

            foreach ($param_pagination as $key => $value) {

                $temp = explode('=',$value);

                $p = $temp[0];
                $v = $temp[1];

                if($p == $param_get){

                    $current_page   = $v;
            
                    $next       .= $p.'='.($v+1);

                    $previous   .= $p.'='.($v-1);
                }

                else {

                    $next       .= $p.'='.$v;
                    $previous   .= $p.'='.$v;
                    $current_page   = $v;
                }
            }

        if($_GET[$param_get] < 2){

            $previous_disabled  = "disabled";
            $previous           = " ";

        } else {

            $previous_disabled  = " ";

        };

        if((ceil($count_result/15) - $_GET[$param_get]) > 0){

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
        $view  .='                     <li class="paginate_button" aria-controls= "example2" data-dt-idx="1" tabindex="2"><a href="#" >'.$_GET[$param_get].'</a></li>';
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
            $view  .= 'Nombre de résultats : '.$count_result.' - Page '.$current_page.'/'.ceil($count_pages/15) ;
        }

        $view  .='                     </li>';
        $view  .='                </ul>';
        $view  .='            </div>';
        $view  .='        </div>';
        $view  .='    </div>';

        return $view ;

    }
}
