<?php namespace Site\View;

/**
*
*/
class Gift

{

    function render($content){

        include('Head.php');

        ?>
        <div class="wrapper">

            <div class="container-fluid">

                <div class="row">


                    <div class="col-md-9 animated slideInLeft" id="aside-left">

                        <h2>Faire un don</h2>
                        <br>

                        <p>Nous sommes enregistrés sur le site de collecte de dons. Benevity. Si votre société (ou employeur) est partenaire de Benevity vous pouvez faire un don à Kalaweit par ce moyen ! Sachez qu'avec le matching fund, votre don à Kalaweit sera multiplié par 2 !</p>

                        <p>Kalaweit a l'agrément ministériel permettant d'établir des reçus fiscaux.</p>

                        <p>Ce reçu fiscal vous permet de déduire de vos impôts 66% du montant de votre don dans la limite de 20% de vos revenus.</p>
                    

                        <div class="row">

                        <div class="col-md-5">
                            <h2>Je donne une fois</h2>
                            <br>
                            <h3>Par chèque :</h3>
                            <br>

                            <p>Ordre : ASSOCIATION KALAWEIT</p>
                            <p>Adresse : 69, rue Mouffetard – 75005 PARIS</p>


                            <h3>Par Paypal : </h3>

                            <br>
                            <p><a target="_blank" href="https://www.paypal.com/cgi-bin/webscr">
                                <img style="width:150px;margin-top:-50px; margin-bottom:0px;" src="/../Documents/Front/logo-paypal.png" class="img-responsive">
                            </a></p>

                        </div>
                        <div class="col-md-1">

                        </div>

                        <div class="col-md-6">
                            <h2>Je donne chaque mois</h2>
                            <br>

                            <p>Le don régulier est de 5€ par mois minimum. C'est le don qui nous aide le plus. Les personnes qui font des dons réguliers sont des Amis de Kalaweit et deviennent automatiquement adhérentes.</p>
                            <h3>Par virement bancaire :</h3>
                            <br>

                            <p><a href="/../Documents/Front/RIB.pdf" target="_blank">Imprimer le RIB</a></p>


                            <h3>Par Paypal : </h3>

                            <br>
                            <p><a target="_blank" href="https://www.paypal.com/cgi-bin/webscr">
                                <img style="width:150px;margin-top:-50px; margin-bottom:-20px;" src="/../Documents/Front/logo-paypal.png" class="img-responsive">
                            </a></p>

                            <p><strong>Pour les personnes ayant un compte bancaire en France: </strong><p>

                                <p><a href="/../Documents/Front/Mandat_prelevement.pdf" target="_blank">Imprimer le formulaire d'autorisation de prélèvement</a></p>

                                <br>

                                <h3>Faire un don régulier par HelloAsso : </h3>
                                <br>

                                <a target="_blank" href="https://www.helloasso.com/associations/kalaweit/formulaires/3/fr">
                                    <img style="height: 32px; " src="/../Documents/Front/helloasso.png" class="img-responsive">
                                </a>

                                <br>
                                <br>

                        </div>

                            </div>

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
