<?php namespace Site\View;

/**
*
*/
class Friends

{

    function render($content){

        include('Head.php');

        if(isset($_SESSION["cli_id"])){
        	$connected = $_SESSION["cli_id"];
        } else {
        	$connected = 'not connected';
        }

        ?>
        <div id="connected" hidden ><?php echo $connected ?></div>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-9 animated slideInLeft" id="aside-left">


                        <h2>Devenir un ami de Kalaweit</h2>
                        <br>
                        <p><strong>Devenir un Ami de Kalaweit est ce qui nous aide le plus !</strong></p>
                        <p>Le don mensuel peut être pour parrainer un gibbon ou pour nous aider à couvrir les dépenses du projet : sauvetages animaux, achat matériel, entretien infrastructures, salaires de l'équipe, patrouilles en forêt, etc..</p>
                        <p>Les Amis sont les personnes qui font un don mensuel régulier. Le minimum est de 5 € par mois. Si Kalaweit atteint le chiffre de 3 500 Amis, alors l’association n’aura pas à craindre pour son avenir !</p>

                        <p><strong>Le don régulier peut se faire :</strong></p>
                        <ul>
                            <li>par prélèvement bancaire. Merci d'imprimer et compléter le formulaire ci-dessous et nous le renvoyer à l'adresse indiquée, en joignant un RIB.</li>
                            <li>avec Paypal.</li>
                            <li>par virement bancaire que vous pouvez mettre en place à partir de votre compte bancaire.</li>
                        </ul>
                        <p>Pensez bien à nous transmettre votre adresse postale sinon le reçu fiscal ne sera pas valable.
                            <p>L'adhésion à l'association est gratuite pour les Amis de Kalaweit. Vous recevrez une carte de membre par email.

                                <?php if(isset($_SESSION["user_login"])){?>

                                    <h2>Moyens de paiment</h2>
                                    <br>
                                    <div id="gift_block" class="row">
                                        <div class="col-md-4">
                                            <h3>Par Paypal : </h3>
                                            <br>
                                            <form action="" method="post">
                                                <input id="gift-amount" type="text" name="gift-amount">
                                                <br>
                                            </form>
                                            <div id="paypal-button-container"></div>
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
                                    <br><br>
                                    <h3>Information</h3>
                                    <p>Kalaweit a l'agrément ministériel permettant d'établir des reçus fiscaux.</p>
                                    <p>Ce reçu fiscal vous permet de déduire de vos impôts 66% du montant du don dans la limite de 20% de vos revenus.</p>
                                <?php } else { ?>
                                    <div class="clo-md-12">
                                        <div class="d-flex justify-content-end">
                                            <a href="/www/Connexion"><button class="btn-form mt20" type="button" name="button">
                                                Se connecter pour devenir ami de Kalaweit
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



            paypal.Buttons({

                createOrder: function(data, actions) {
                    console.log(data);
                    console.log(actions);
                    var liste, texte;
                    liste = document.getElementById("gift-amount");
                    /*texte = liste.options[liste.selectedIndex].value;*/
                    texte = liste.value;

                    return actions.order.create({
                        purchase_units: [{
                            reference_id : "Adhesion-"+sessionId,
                            amount: {
                                value: texte
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
                        console.log(details.payer.name["given_name"]);
                        console.log(data2);

                        var xhr = new XMLHttpRequest();
                        xhr.open('GET', 'http://localhost:8888/www/Insert_gift?'+data2);
                        xhr.onload = function() {
                            if (xhr.status === 200) {
                                alert('Votre don a bien été enregistré, votre reçu sera disponible dès que nous aurrons la confirmation du paiement.');
                            }
                            else {
                                alert('Nous avons rencontrez un soucis , merci de renouveler votre don utlérieurement');
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
