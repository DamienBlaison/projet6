<?php
namespace Site\Controller;
/**
 *
 */
class Insert_gift
{
    function Insert_gift(){

        $bdd = new \Kalaweit\Manager\Connexion();
        $bdd = $bdd->getBdd();

        $amount = $_POST["amount"];
        $id = $_POST["id"];

        $reqprep = $bdd->prepare("INSERT INTO wf_theme (thm_name , thm_description) VALUES (:amount,:id)");

        $prepare = [
            ":amount" => $_amount,
            ":id" =>$id ]
            ;

        $reqprep->execute($prepare);
    }

}

 ?>
