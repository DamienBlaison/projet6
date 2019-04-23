<?php
namespace Kalaweit\Manager;

class Connexion

{
    function getBdd(){

        $host = 'localhost';
        $user = "root";
        $pass = "root";
        $db   = 'kalaweitv2';

        $bdd = new \PDO("mysql:host=$host;dbname=$db;charset=utf8", $user,$pass);

        return $this->bdd = $bdd;

    }

}


?>
