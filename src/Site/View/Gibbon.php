<?php namespace Site\View;

/**
*
*/
class Gibbon
{

    function render($content){


        include('Head.php');

        if(isset($_SESSION["cli_id"])){
        	$connected = $_SESSION["cli_id"];
        }else{
        	$connected = 'not connected';
        }

        ?>
        <div id="connected" hidden ><?php echo $connected ?></div>
        <div class="wrapper">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-9 animated slideInLeft" id="aside-left">
                        <div class="tz-gallery">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-between">
                                        <div class="col-md-9">
                                            <h2 class="animated fadeInLeft"><?php echo $content["info_gibbon"]["ac_name"] ?></h2>
                                        </div>

                                        <div id="remove_make_gift">
                                            <?php if(isset($_SESSION["user_login"])){?>

                                                <button id="make_gift" class= "make_gift">Faire un don</button></a>

                                            <?php } else { ?> <a  id="make_gift3" href="/www/Connexion"><button class="btn-form mt20" type="button" name="button">
                                                Se connecter
                                            </button></a> <?php } ?>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-12 col-md-6">
                                    <?php if($content["info_gibbon"]["acm_1"] =='px.gif' || $content["info_gibbon"]["acm_1"] =='' || $content["info_gibbon"]["acm_1"] =='0' ){} else {?>
                                        <div class="thumbnail picture-gibbon">
                                            <img class="animated fadeInUp" src="/../Documents/Asso_cause/<?php echo $content["info_gibbon"]["acm_1"] ?>" alt="<?php echo $content["info_gibbon"]["acm_2"] ?>">
                                        </div> <?php
                                    } ?>
                                </div>
                                <div class="col-sm-12 col-md-6">

                                    <?php if($content["info_gibbon"]["acm_2"] =='px.gif' || $content["info_gibbon"]["acm_2"] =='' || $content["info_gibbon"]["acm_2"] =='0' ){} else {?>
                                        <div class="thumbnail picture-gibbon">
                                            <img class="animated fadeInUp" src="/../Documents/Asso_cause/<?php echo $content["info_gibbon"]["acm_2"] ?>" alt="<?php echo $content["info_gibbon"]["acm_2"] ?>">
                                        </div> <?php
                                    } ?>

                                </div>
                            </div>

                            <div id="donation_mnt" class="" hidden>
                                <?php echo $content["donation"][0]?>
                            </div>

                            <ul>

                                <li>Age : <?php echo $content["info_gibbon"]["actd_3"] ?> an(s)</li>
                                <li>Sexe : <?php echo $content["info_gibbon"]["actd_2"] ?></li>
                                <li>Île : <?php echo $content["info_gibbon"]["actd_1"] ?></li>
                                <li>Espèce : <?php

                                foreach ($content["species"] as $key => $value) {

                                    if($value["id_espece"] == $content["info_gibbon"]["actd_3"]) { $specie = [$value["nom_francais"],$value["nom_latin"]];}
                                    // code...
                                }

                                echo $specie[0]." / ".$specie[1]?></li>

                                <li>Liste des parrains : <?php echo $content["donator"] ?></li>
                                <li>Somme collectée poour l'année en cours : <?php if( $content["donation"][0] != NULL){ echo $content["donation"][0];} else { echo '0 ';}?> € / 280 €</li>

                            </ul>

                            <h3>Description</h3>
                            <p>
                                <?php echo $content["info_gibbon"]["acm_3"] ?>
                            </p>

                            <br>

                            <div id="remove_make_gift2" class="d-flex justify-content-end">

                                <?php if(isset($_SESSION["user_login"])){?>

                                    <button id="make_gift2" class= "make_gift">Faire un don</button></a>

                                <?php } else { ?> <a  id="make_gift4" href="/www/Connexion"><button class="btn-form mt20" type="button" name="button">
                                    Se connecter
                                </button></a> <?php } ?>


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

                                            <form action="" method="post">

                                                <input id="gift-amount" class="form-control">

                                            </form>

                                            <br>

                                            <div id="paypal-button-container"></div>

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

                                            <!--
                                            <h3>Par Paypal : </h3>

                                            <br>
                                            <p><a target="_blank" href="https://www.paypal.com/cgi-bin/webscr">
                                            <img style="width:150px;margin-top:-50px; margin-bottom:-20px;" src="/../Documents/Front/logo-paypal.png" class="img-responsive">
                                        </a></p>
                                    -->

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
    <?php

    include("Footer.php");

    ?>

    <?php if(isset($_SESSION["user_login"])){ ?>

    <script type="text/javascript">

    function hide_btn_1(){

        if (document.getElementById("donation_mnt").innerHTML >= 280){
            document.getElementById("remove_make_gift").removeChild(document.getElementById("make_gift"));


            var donationClosed = document.createElement('button');
            donationClosed.innerHTML = "Don cloturé";
            donationClosed.className = "make_gift";
            document.getElementById("remove_make_gift").appendChild(donationClosed);
        };
    }

    function hide_btn_2(){

        if (document.getElementById("donation_mnt").innerHTML >= 280){
            document.getElementById("remove_make_gift2").removeChild(document.getElementById("make_gift2"));
        };
    }

    hide_btn_1();
    hide_btn_2();

    </script>

<?php } else { ?>

    <script type="text/javascript">

    function hide_btn_1(){

        if (document.getElementById("donation_mnt").innerHTML >= 280){
            document.getElementById("remove_make_gift").removeChild(document.getElementById("make_gift3"));


            var donationClosed = document.createElement('button');
            donationClosed.innerHTML = "Don cloturé";
            donationClosed.className = "make_gift";
            document.getElementById("remove_make_gift").appendChild(donationClosed);
        };
    }

    function hide_btn_2(){

        if (document.getElementById("donation_mnt").innerHTML >= 280){
            document.getElementById("remove_make_gift2").removeChild(document.getElementById("make_gift4"));
        };
    }

    hide_btn_1();
    hide_btn_2();

    </script>


<?php } ?>

    <?php

    if (isset($_SESSION["user_login"])) {?>

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
        console.log(document.getElementById("donation_mnt").innerHTML);



        </script>
        <script src="https://www.paypal.com/sdk/js?client-id=sb&currency=EUR"></script>
        <script>

        var sessionId = document.getElementById("connected").innerHTML;

        paypal.Buttons({

            createOrder: function(data, actions) {
                console.log(data);
                console.log(actions);

                var amount_donation = document.getElementById("gift-amount").value;

                var search = location.search;

                var search = search.replace("?cau_id=", "");

                console.log(search);

                console.log(amount_donation);

                return actions.order.create({
                    purchase_units: [{
                        reference_id : "gift_one_shot_gibbon-"+sessionId+'-'+ search,
                        amount: {
                            value: amount_donation
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    alert('Transaction completed by ' + details.payer.name.given_name);
                    console.log(details);

                    var dataString = {

                        "transaction" : details.purchase_units[0].reference_id,
                        "amount": details.purchase_units[0].amount.value,
                        "email" : details.payer["email_address"],
                        "surname" : details.payer.name["surname"],
                        "given_name" : details.payer.name["given_name"],
                        "phone" : details.payer.phone.phone_number["national_number"],
                        "payer_id" : details.payer["payer_id"]

                    };

                    var data2 = 'transaction='+dataString["transaction"]+'&amount='+dataString["amount"]+'&email='+dataString["email"]+'&surname='+dataString["surname"]+'&given_name='+dataString["given_name"]+'&phone='+dataString["phone"];

                    console.log(details.purchase_units[0].reference_id);
                    console.log(data2);

                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', 'http://localhost:8888/www/Insert_gift?'+data2);
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            alert('Maj ok');
                        }
                        else {
                            alert('Request failed.  Returned status of ' + xhr.status);
                        }
                    };
                    xhr.send(dataString);

                    return fetch('__DIR__."/../paypal-transaction-complete"', {
                        method: 'post',
                        headers: {
                            'content-type': 'application/json'
                        },
                        body: JSON.stringify({
                            orderID: data.orderID
                        })
                    });
                });
            }
        }).render('#paypal-button-container');
        </script><?php
    } else {


    }
}
}
?>
