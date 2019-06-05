<?php

$host = 'localhost';
$user = "root";
$pass = "root";
$db   = 'kalaweitv2';

$bdd = new \PDO("mysql:host=$host;dbname=$db;charset=utf8", $user,$pass);

$req = $bbd->prepare("INSERT INTO crm_client_type (brk_id,clit_name,clit_code) VALUES (2,"test","test")");
$req->execute();



 ?>
