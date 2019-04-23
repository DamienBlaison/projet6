<?php
namespace Kalaweit\Manager;

class Asso_adhesion
{
    use \Kalaweit\Transverse\Get_param_request;
    /**
    * définition des variables de classe
    */

    private $bdd;

    /**
    * définition du constructeur
    */

    function __construct($bdd)
    {
        $this->bdd = $bdd;
    }

    function add(){
        if(isset($_POST["adhesion_mnt"])){

            $reqprep = $this->bdd->prepare(

                "INSERT INTO
                asso_adhesion

                ( brk_id , cli_id , adhesion_mnt , ptyp_id, adhesion_ts  )

                VALUES

                ( :brk_id, :cli_id, :adhesion_mnt, :ptyp_id , :adhesion_ts)

                "

            );

            $prepare = [

                ":brk_id" => 2,
                ":cli_id" => $_POST['cli_id'],
                ":adhesion_mnt"=> $_POST['adhesion_mnt'],
                ":ptyp_id"=> $_POST['ptyp_id'],
                ":adhesion_ts" => date('Y-m-d G:i:s')//, mktime(0, 0, 0, $_timestamp["M"], $_timestamp["D"], $_timestamp["Y"]))
            ];

            $insert = $reqprep->execute($prepare);

        }
    }

    function get_last(){

        $reqprep = $this->bdd->query(
            "SELECT

            asso_adhesion.adhesion_id as Id_adhesion,

            asso_adhesion.cli_id as Id_Parrain,
            P2.cli_firstname as Prénom,
            P2.cli_lastname as Nom,

            asso_adhesion.adhesion_mnt as Montant,
            asso_adhesion.adhesion_ts as Date_creation

            FROM

            asso_adhesion

            LEFT JOIN crm_client as P2 ON P2.cli_id = asso_adhesion.cli_id

            ORDER BY

            asso_adhesion.adhesion_ts DESC

            LIMIT 0,9
            ");





            //$prepare = [":adhesion_ts" => $_GET['adhesion_ts']];

            $data = [
                "content"     => $reqprep->fetchAll(\PDO::FETCH_NUM),
                "head"              => ["Id","Id_membre","Prénom","Nom","Montant","Date enregistrement"],
            ];

            return $data;

        }

        function get_adhesion_by_member(){

            if( isset($_GET['p']) )

            { $filter = $_GET['p'] ; } else { $filter = 0; };

            $reqprep = $this->bdd->prepare(
                "SELECT

                asso_adhesion.adhesion_id as Id_adhesion,

                asso_adhesion.adhesion_mnt as Montant,
                asso_adhesion.adhesion_ts as Date_creation

                FROM

                asso_adhesion

                LEFT JOIN crm_client as P2 ON P2.cli_id = asso_adhesion.cli_id

                WHERE P2.cli_id = :cli_id

                ORDER BY

                asso_adhesion.adhesion_ts DESC

                LIMIT $filter,5

                ");

                $prepare = [
                    ":cli_id" => $_GET['cli_id']
                ];

                $reqprep->execute($prepare);

                $count_reqprep = $this->bdd->prepare("SELECT COUNT(adhesion_id) FROM asso_adhesion WHERE 1=1 and cli_id = :cli_id ");

                $count_prepare = [
                    ":cli_id" => $_GET['cli_id']
                ];

                $count_reqprep->execute($count_prepare );


                $list_adhesion_member = $reqprep->fetchAll(\PDO::FETCH_NUM);
                $count_adhesion_member = $count_reqprep->fetch(\PDO::FETCH_NUM);

                $return = [
                    "list_adhesion" => $list_adhesion_member ,
                    "count" => $count_adhesion_member,
                    "head"=>["Id","Id_cause","Bénéficaire","Montant","Date création"]];

                    return $return ;

                }

                function get_list(){

                    $where = '';

                    $param_request = $this->Get_param_request();

                    foreach ($param_request[0] as $key => $value) {
                        if($value != ''){

                            switch (substr($key,0,3)) {

                                case 'adh':
                                $key_table = 'asso_adhesion.'.$key;// code...
                                break;
                                case 'cli':
                                $key_table = 'P2.'.$key;// code...
                                break;

                            }

                            $where .= ' AND '.$key_table.' LIKE :'.$key ;


                        }
                    }


                    if (isset($param_request[1]) && ($param_request[1] != 'get')){$filter = (($param_request[1])-1)*15;}else{$filter = 0;}


                    $reqprep = $this->bdd->prepare(
                        "SELECT

                        asso_adhesion.adhesion_id as Id_adhesion,

                        asso_adhesion.cli_id as Id_Parrain,
                        P2.cli_firstname as Prénom,
                        P2.cli_lastname as Nom,

                        asso_adhesion.adhesion_mnt as Montant,
                        asso_adhesion.adhesion_ts as Date_creation

                        FROM

                        asso_adhesion

                        LEFT JOIN crm_client as P2 ON P2.cli_id = asso_adhesion.cli_id

                        WHERE

                        1=1

                        $where

                        ORDER BY

                        asso_adhesion.adhesion_ts DESC

                        LIMIT $filter,20

                        ");

                        $count_reqprep = $this->bdd->prepare("SELECT COUNT(adhesion_id) FROM asso_adhesion WHERE 1=1 $where ");

                        if($param_request[0] != []){

                            foreach ($param_request[0] as $key => $value) {
                                if($value != ''){

                                    $reqprep->bindValue(":".$key,$value);
                                    $count_reqprep->bindValue(":".$key,$value);

                                }
                            }
                        }

                        $reqprep->execute();

                        $count_result   = $count_reqprep->execute();
                        $count_result   = $count_reqprep->fetch(\PDO::FETCH_NUM);

                        $value = [];


                        $data = [
                            "list_adhesion"     => $reqprep->fetchAll(\PDO::FETCH_NUM),
                            "head"              => ["Id","Id_membre","Prénom","Nom","Montant","Date enregistrement"],
                            "count"             => $count_result
                        ];

                        return $data;
                    }

                    public function delete()
                    {
                        $reqprep = $this->bdd->prepare(
                            "DELETE FROM asso_adhesion
                            WHERE adhesion_id=:adhesion_id ");
                            $prepare = [":adhesion_id" => $_GET["adhesion_id"]];

                            $reqprep->execute($prepare);

                            header("Location: ".$_SERVER['HTTP_REFERER']);

                        }

                        public function update(){

                            $reqprep = $this->bdd->prepare(

                                "UPDATE asso_adhesion

                                SET
                                cli_id     = :cli_id,
                                adhesion_mnt    = :adhesion_mnt,
                                ptyp_id    = :ptyp_id

                                WHERE
                                adhesion_id = :adhesion_id "
                            );

                            $prepare = [
                                ":cli_id" => $_POST["cli_id"],
                                ":adhesion_mnt" => $_POST["adhesion_mnt"],
                                ":ptyp_id" => $_POST["ptyp_id"],
                                ":adhesion_id" => $_GET["adhesion_id"]
                            ];

                            $reqprep->execute($prepare);

                            switch ($_GET["from"]) {
                                case 'add':
                                    header("Location: http://localhost:8888/www/Kalaweit/asso_adhesion/add");
                                break;

                                default:
                                    header("Location: http://localhost:8888/www/Kalaweit/asso_adhesion/list/1");
                                break;
                            }

                        }

                        public function get()
                        {
                            $reqprep = $this->bdd->prepare("SELECT * FROM asso_adhesion WHERE adhesion_id = :adhesion_id");


                            $prepare = [ ":adhesion_id" => $_GET['adhesion_id'] ];

                            $reqprep->execute($prepare);

                            return $data = $reqprep->fetch(\PDO::FETCH_ASSOC);

                        }

                        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                        //charts management//
                        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                        public function get_chart_data_count($year){

                            $begin = $year.'-01-01 00:00:00';
                            $end = $year.'-12-31 23:59:59';

                            $data = [];

                            for ($i=1; $i < 13; $i++) {

                                $sum = $this->bdd->query("SELECT COUNT(adhesion_mnt) FROM asso_adhesion WHERE YEAR(adhesion_ts)= $year and MONTH(adhesion_ts)= $i ");

                                array_push($data,$sum->fetch(\PDO::FETCH_NUM ));

                            }

                            return $data;

                        }
                        public function get_chart_data_sum($year){

                            $begin = $year.'-01-01 00:00:00';
                            $end = $year.'-12-31 23:59:59';

                            $data = [];

                            for ($i=1; $i < 13; $i++) {

                                $sum = $this->bdd->query("SELECT SUM(adhesion_mnt) FROM asso_adhesion WHERE YEAR(adhesion_ts)= $year and MONTH(adhesion_ts)= $i ");

                                array_push($data,$sum->fetch(\PDO::FETCH_NUM ));

                            }

                            return $data;

                        }

                        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                        //resume management//
                        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                        public function get_resume_data_sum($year){

                            $begin = $year.'-01-01 00:00:00';
                            $end = $year.'-12-31 23:59:59';

                            $data = [];

                            for ($i=1; $i < 13; $i++) {

                                $sum = $this->bdd->query("SELECT SUM(adhesion_mnt) FROM asso_adhesion WHERE YEAR(adhesion_ts)= $year and MONTH(adhesion_ts)= $i ");

                                $temp = $sum->fetch(\PDO::FETCH_NUM );

                                $data[] = $temp[0];
                            }

                            return $data;

                        }

                        public function get_resume_data_count($year){

                            $begin = $year.'-01-01 00:00:00';
                            $end = $year.'-12-31 23:59:59';

                            $data = [];

                            for ($i=1; $i < 13; $i++) {

                                $sum = $this->bdd->query("SELECT COUNT(adhesion_mnt) FROM asso_adhesion WHERE YEAR(adhesion_ts)= $year and MONTH(adhesion_ts)= $i ");

                                $temp = $sum->fetch(\PDO::FETCH_NUM );

                                $data[] = $temp[0];
                            }

                            return $data;

                        }



                    }
