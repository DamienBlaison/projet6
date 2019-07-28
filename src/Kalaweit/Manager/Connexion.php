<?php
namespace Kalaweit\Manager;

class Connexion

{
    function getBdd(){

        $online = 1;// 0 ou 1

        if($online == 0){

            //config locale

            $host = 'localhost:8889';
            $user = "root";
            $pass = "root";
            $db   = 'kalaweitv2';

        } else {

            $host = 'db5000130112.hosting-data.io:3306';
            $user = "dbu346301";
            $pass = "Passwordbdd57100!";
            $db   = 'dbs124813';
        }

        //include('./../../../vendor/autoload.php');

        $bdd = new \PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
        //$bdd = new \PDO("mysql:host=127.0.0.1;dbname=$db;charset=utf8", $user, $pass);

        return $bdd;

    }

}
