<?php namespace Site\View;

/**
*
*/
class Gibbon
{

    function render($content){

        include('Head.php');

        ?>
        <div class="wrapper">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-9 animated slideInLeft" id="aside-left">
                        <div class="tz-gallery">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-between">
                                        <div class="col-md-9">
                                            <h2 class="animated fadeInLeft">Abduk</h2>
                                        </div>


                                    <button id="make_gift" class= "make_gift">Faire un don</button>

                                    </div>
                                </div>


                                <div class="col-sm-12 col-md-6">
                                    <div class="thumbnail picture-gibbons ">
                                        <img class="animated fadeInUp " src="/../Documents/Front/3-20180203113327.png" alt="Park">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="thumbnail picture-gibbons">

                                        <img class="animated fadeInUp" src="/../Documents/Front/3-20180203113327.png" alt="Park">


                                    </div>
                                </div>
                            </div>



                            <ul>

                                <li>Age : 6 ans</li>
                                <li>Sexe : M</li>
                                <li>Île : Bornéo</li>
                                <li>Espèce : Gibbon agile (Hylobates agilis albibarbis)</li>

                                <li>Liste des parrains : Lemesle Gaelle, Hélène Botalla-Piretta, Veronique Roques, Fanny Darte, Caroline Darte</li>
                                <li>Somme restante pour son adoption: 70€</li>

                            </ul>

                            <h3>Description</h3>
                            <p>





                                Abduk est un jeune male gibbon de l’espèce Hylobates Agilis albibarbis, l’une des espèces de gibbons qui vit sur l’ile de Bornéo, en Indonésie.

                                L’estimation de l’année de sa naissance : 2013.

                                notes :

                                Pararawen Conservation Centre et Sanctuaire, Muara Teweh, au centre de Bornéo.

                                Janvier 2019

                                Abduk va bien. Il est actif et mange bien les fruits.

                                Août 2016

                                Le 14 août 2016, Abduk a été sauvé dans une ville à Jabiren, une ville qui est située à une bonne dizaines de kilomètres de Palangkaraya.

                                Abduk est ensuite emmené au centre de Pararawen, Muara Teweh, au centre de Bornéo.

                                Abduk va bien.

                            </p>



                            <div class="d-flex justify-content-end">

                                <button id="make_gift2" class= "make_gift">Faire un don</button></a>


                            </div>

                            <br>

                            <div id="block_gift" class="hidden" >

                                <h2>Comment faire un don ?</h2>


                                <p>Nous sommes enregistrés sur le site de collecte de dons. Benevity. Si votre société (ou employeur) est partenaire de Benevity vous pouvez faire un don à Kalaweit par ce moyen ! Sachez qu'avec le matching fund, votre don à Kalaweit sera multiplié par 2 !</p>

                                <p>Kalaweit a l'agrément ministériel permettant d'établir des reçus fiscaux.</p>

                                <p>Ce reçu fiscal vous permet de déduire de vos impôts 66% du montant de votre don dans la limite de 20% de vos revenus.</p>

                                <br><br>

                                <div class="container">
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

        ?>

        <script type="text/javascript">

        document.getElementById("make_gift2").addEventListener("click", function(){show_gift();});
        document.getElementById("make_gift").addEventListener("click", function(){show_gift2();});

        function show_gift(){
            document.getElementById("block_gift").className = 'animated bounceInUp';
        };

        function show_gift2(){

            document.getElementById("make_gift2").scrollIntoView({behavior:'smooth'});

            setTimeout( show_gift(), 3000);

        }

        </script>
        <?php
    }

}
?>
