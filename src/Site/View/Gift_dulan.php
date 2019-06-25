<?php namespace Site\View;

/**
*
*/
class Gift_dulan

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


                        <h2>Faire un don pour la foret</h2>
                        <br>

                        <p>Le prix d'un hectare de forêt dans cette réserve est de 900 €, soit 9 € pour 100 m² de forêt.</p>
                        <p>Vous recevrez un certificat de propriété symbolique, avec votre nom, le montant de votre don et le nombre de m² financés.</p>
                        <p>Merci de renseigner votre adresse postale afin que le reçu fiscal soit accepté par votre centre des impôts.</p>
                        <p> Sans votre adresse postale il ne sera pas valable. Ce reçu fiscal vous permet de déduire de vos impôts 66% du montant de votre don dans la limite de 20% de vos revenus.</p>

                        <br><br>

                        <?php if(isset($_SESSION["user_login"])){?>

                        <div class="row">


                            <div class="col-md-4">


                                <h3>Par Paypal : </h3>

                                <br>
                                <form action="" method="post">

                                    <input id="gift-amount" class="form-control">

                                </form>

                                <br>

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

                                <a target="_blank" href="https://www.helloasso.com/associations/kalaweit/collectes/faire-un-don-pour-sauver-la-foret-de-dulan">
                                    <img style="height: 32px; " src="/../Documents/Front/helloasso.png" class="img-responsive">
                                </a>

                                <br>
                                <br>
                            </div>
                        </div>
                        <br><br>
                        <p>Kalaweit a l'agrément ministériel permettant d'établir des reçus fiscaux.</p>

                        <p>Ce reçu fiscal vous permet de déduire de vos impôts 66% du montant du don dans la limite de 20% de vos revenus.)</p>


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

    paypal.Buttons({

        createOrder: function(data, actions) {
            console.log(data);
            console.log(actions);

            var amount_donation = document.getElementById("gift-amount").value;

            return actions.order.create({
                purchase_units: [{
                    reference_id : "gift_one_shot_dulan-"+sessionId,
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
    </script>
    <?php

    include("Footer.php");
}

}
?>
