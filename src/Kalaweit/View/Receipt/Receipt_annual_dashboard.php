<?php namespace Kalaweit\View\Receipt;

class Receipt_annual_dashboard
{
    function render($content){

        require_once( __DIR__ .'/../Head.php');

        ?>

        <section class="content">
            <form name="member" action="" method="post">
                <div class="container-fluid" style="padding-left:0px;">

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Génération des recus fiscaux</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <button id="receipt_generator" type="button" name="button" class="btn btn-primary col-md-2">Lancer le traitement</button>
                            <div id="progress_receipt_annual" class="col-md-10">
                                <?php echo $content["Receipt_generation_progress"] ?>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    </div>
            </form>
        </section>

        <?php

        require_once( __DIR__ .'/../footer.php');

        ?>

        <script type="text/javascript">

        function generateReceipt(){

            var xhttp = new XMLHttpRequest();
            //xhttp.onreadystatechange = function() {
            //    if (this.readyState == 4 && this.status == 200) {
            //        document.getElementById("demo").innerHTML = this.responseText;
            //    }
            //};
            xhttp.open("GET", "/src/Kalaweit/Controller/test.php", true);
            //xhttp.open("GET", "/www/Kalaweit/Receipt_annual_dashboard/run", true);
            xhttp.send();

        }

        document.getElementById('receipt_generator').addEventListener('click', function(){ generateReceipt();});

        function majProgressReceiptGeneration(){

            var xhttp = new XMLHttpRequest();

            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    console.log(this.responseText);

                    document.getElementById("Receipt_annual_generation_progress").style.width = this.responseText +'%';
                    document.getElementById("Receipt_annual_generation_progress").ariaValuenow = this.responseText ;
                }
            };

            xhttp.open("GET", "/www/Kalaweit/Progress/Receipt_annual_generation_progress", true);
            xhttp.send();

        }

        setInterval(majProgressReceiptGeneration, 500);

        </script>

        <?php
    }

}
