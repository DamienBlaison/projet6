<?php

namespace Site\Controller;

/**
*
*/
class Insert_gift
{

    function render()
    {

        $url = $_SERVER['REQUEST_URI'];
        $params = explode('?',$url);

        $datas = explode('&',$params[1]);

        $transaction = explode('-',$datas[0]);

        if ($transaction[0] == 'transaction=Adhesion'){

            $bdd = new \Kalaweit\Manager\Connexion();
            $bdd = $bdd->getBdd();

            $reqprep = $bdd->prepare("INSERT INTO asso_adhesion (brk_id ,cli_id,adhesion_ts,adhesion_status,adhesion_mnt,ptyp_id) VALUES (2,:cli_id,:adhesion_ts,'WAIT',:amount,1)");

            $prepare = [
                ":cli_id" =>$transaction[1],
                ":adhesion_ts" =>date("Y-m-d H:i:s"),
                ":amount" => $_GET["amount"],
            ];

            $reqprep->execute($prepare);

        }

        if ($transaction[0] == 'transaction=gift_one_shot'){

            $bdd = new \Kalaweit\Manager\Connexion();
            $bdd = $bdd->getBdd();

            $reqprep = $bdd->prepare("INSERT INTO asso_donation (brk_id ,cli_id,cau_id,don_ts,don_status,don_mnt,ptyp_id) VALUES (2,:cli_id,704,:don_ts,'WAIT',:amount,1)");

            $prepare = [
                ":cli_id" =>$transaction[1],
                ":don_ts" =>date("Y-m-d H:i:s"),
                ":amount" => $_GET["amount"],
            ];

        }


        if ($transaction[0] == 'transaction=gift_one_shot_gibbon'){

            $bdd = new \Kalaweit\Manager\Connexion();
            $bdd = $bdd->getBdd();

            $reqprep = $bdd->prepare("INSERT INTO asso_donation (brk_id ,cli_id,cau_id,don_ts,don_status,don_mnt,ptyp_id) VALUES (2,:cli_id,:cau_id,:don_ts,'WAIT',:amount,1)");

            $prepare = [
                ":cli_id" =>$transaction[1],
                ":cau_id" => $transaction[2],
                ":don_ts" =>date("Y-m-d H:i:s"),
                ":amount" => $_GET["amount"],
            ];

            $reqprep->execute($prepare);

        }

        if ($transaction[0] == 'transaction=gift_one_shot_forest'){

            $bdd = new \Kalaweit\Manager\Connexion();
            $bdd = $bdd->getBdd();

            $reqprep = $bdd->prepare("INSERT INTO asso_donation (brk_id ,cli_id,cau_id,don_ts,don_status,don_mnt,ptyp_id) VALUES (2,:cli_id,703,:don_ts,'WAIT',:amount,1)");

            $prepare = [
                ":cli_id" =>$transaction[1],
                ":don_ts" =>date("Y-m-d H:i:s"),
                ":amount" => $_GET["amount"],
            ];

            $reqprep->execute($prepare);

        }

        if ($transaction[0] == 'transaction=gift_one_shot_dulan'){

            $bdd = new \Kalaweit\Manager\Connexion();
            $bdd = $bdd->getBdd();

            $reqprep = $bdd->prepare("INSERT INTO asso_donation (brk_id ,cli_id,cau_id,don_ts,don_status,don_mnt,ptyp_id) VALUES (2,:cli_id,700,:don_ts,'WAIT',:amount,1)");

            $prepare = [
                ":cli_id" =>$transaction[1],
                ":don_ts" =>date("Y-m-d H:i:s"),
                ":amount" => $_GET["amount"],
            ];

            $reqprep->execute($prepare);

        }

    }
}
