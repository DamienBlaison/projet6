<?php
namespace Kalaweit\View\Annual_report\Component;

class Donation_one_shot

{

    function render($id,$title,$data,$col){

        $data_json = json_encode($data);

        $chartJs  = '';

        $chartJs .= '<section class="col-md-'.$col.'">';
        $chartJs .= '<div class="box box-primary">';
        $chartJs .= '        <div class="box-header with-border">';
        $chartJs .= '          <h3 class="box-title">'.$title.'</h3>';
        $chartJs .= '          <div class="box-tools pull-right">';
        $chartJs .= '            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>';
        $chartJs .= '            </button>';
        $chartJs .= '            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>';
        $chartJs .= '          </div>';
        $chartJs .= '        </div>';
        $chartJs .= '        <div class="box-body">';
        $chartJs .= '          <div class="chart">';
        $chartJs .= '            <canvas id="'.$id.'" width="300" height="300"></canvas>';
        $chartJs .= '          </div>';
        $chartJs .= '        </div>';
        $chartJs .= '        <!-- /.box-body -->';
        $chartJs .= '      </div>';
        $chartJs .= '      </section>';

        $chartJs .= "<script>

        var ctx = document.getElementById('".$id."' ).getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['01', '02', '03', '04', '05', '06','07','08','09','10','11','12'],
                datasets: [{
                    label: 'Nb',
                    data: ".$data_json.",
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(54, 162, 235, 0.6)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 0.5
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        </script>";


        return $chartJs;
    }

}
