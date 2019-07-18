<?php
namespace Kalaweit\Manager;

class Connexion

{
    function getBdd(){

        $online = 0 ;// 0 ou 1

        if($online == 0){

            //config locale

            $host = 'localhost';
            $user = "root";
            $pass = "root";
            $db   = 'kalaweitv2';

        } else {

            $host = 'db5000130112.hosting-data.io';
            $user = "dbu346301";
            $pass = "Bdddbu34630157100!";
            $db   = 'dbs124813';
        }

        $bdd = new \PDO("mysql:host=$host;dbname=$db;charset=utf8", $user,$pass);

        return $this->bdd = $bdd;

    }

}


?>
