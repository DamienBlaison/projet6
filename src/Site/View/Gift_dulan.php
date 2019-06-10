<?php namespace Site\View;

/**
*
*/
class Gift_dulan

{

    function render($content){

        include('Head.php');

        ?>
        <div class="wrapper">

            <div class="container-fluid">

                <div class="row">


                    <div class="col-md-9 animated slideInLeft" id="aside-left">


                        <h2>Faire un don pour la foret</h2>
                        <br>

                        <p>Le prix d'un hectare de forêt dans cette réserve est de 900 €, soit 9 € pour 100 m² de forêt.</p>
                        <p>Vous recevrez un certificat de propriété symbolique, avec votre nom, le montant de votre don et le nombre de m² financés.</p>
                        <p>Merci de renseigner votre adresse postale afin que le reçu fiscal soit accepté par votre centre des impôts.</p>
                        <p> Sans votre adresse postale il ne sera pas valable. Ce reçu fiscal vous permet de déduire de vos impôts 66% du montant de votre don dans la limite de 20% de vos revenus.</p>

                        <br><br>

                        <div class="row">


                            <div class="col-md-4">


                                <h3>Par Paypal : </h3>

                                <br>
                                <p><a target="_blank" href="https://www.paypal.com/cgi-bin/webscr">
                                    <img style="width:150px;margin-top:-50px; margin-bottom:0px;" src="/../Documents/Front/logo-paypal.png" class="img-responsive">
                                </a></p>

                            </div>
                            <div class="col-md-4">

                                <h3>Par prélèvement automatique : </h3>
                                <br>

                                <p><a href="/../Documents/Front/Mandat_prelevement.pdf" target="_blank">Imprimer le formulaire <br>d'autorisation de prélèvement</a></p>

                                <br>
                                <br>
                            </div>
                            <div class="col-md-4">
                                <h3>Par HelloAsso : </h3>
                                <br>

                                <a target="_blank" href="https://www.helloasso.com/associations/kalaweit/formulaires/3/fr">
                                    <img style="height: 32px; " src="/../Documents/Front/helloasso.png" class="img-responsive">
                                </a>

                                <br>
                                <br>
                            </div>
                        </div>
                        <p>Kalaweit a l'agrément ministériel permettant d'établir des reçus fiscaux.</p>

                        <p>Ce reçu fiscal vous permet de déduire de vos impôts 66% du montant du don dans la limite de 20% de vos revenus.)</p>
                    </div>

                    <div class="col-md-3 animated slideInRight">
                        <?php
                        echo $content["aside"];
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php

    include("Footer.php");
}

}
?>
