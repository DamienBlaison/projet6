<?php namespace Site\View;

/**
*
*/
class Gift

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

                        <h2>Faire un don</h2>
                        <br>

                        <p>Nous sommes enregistrés sur le site de collecte de dons. Benevity. Si votre société (ou employeur) est partenaire de Benevity vous pouvez faire un don à Kalaweit par ce moyen ! Sachez qu'avec le matching fund, votre don à Kalaweit sera multiplié par 2 !</p>

                        <p>Kalaweit a l'agrément ministériel permettant d'établir des reçus fiscaux.</p>

                        <p>Ce reçu fiscal vous permet de déduire de vos impôts 66% du montant de votre don dans la limite de 20% de vos revenus.</p>

                        <?php if(isset($_SESSION["user_login"])){?>

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


                            <!--<h3>Par Paypal : </h3>

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

                        <?php } else { ?>

                            <div class="clo-md-12">
                                <div class="d-flex justify-content-end">

                                    <a href="/www/Connexion"><button class="btn-form mt20" type="button" name="button">
                                        Se connecter pour faire un don
                                    </button></a>
                                </div>
                            </div>

                        <?php } ?>

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
            <script src="https://www.paypal.com/sdk/js?client-id=sb&currency=EUR"></script>


            <script>


            var sessionId = document.getElementById("connected").innerHTML;

            console.log(sessionId);

            paypal.Buttons({

                createOrder: function(data, actions) {
                    console.log(data);
                    console.log(actions);

                    var amount_donation = document.getElementById("gift-amount").value;



                    console.log(amount_donation);

                    return actions.order.create({
                        purchase_units: [{
                            reference_id : "gift_one_shot-"+sessionId,
                            amount: {
                                value: amount_donation
                            }
                        }],

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
            </script>
            <?php

            include("Footer.php");
        }

    }
    ?>
