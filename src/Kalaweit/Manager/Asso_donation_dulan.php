<?php
namespace Kalaweit\Manager;

class Asso_donation_dulan
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
        if(isset($_POST["donation_dulan_mnt"])){

            $reqprep = $this->bdd->prepare(

                "INSERT INTO
                asso_donation

                ( brk_id , cli_id , don_mnt , ptyp_id, don_ts, cau_id  )

                VALUES

                ( :brk_id, :cli_id, :donation_dulan_mnt, :ptyp_id , :donation_dulan_ts, :cau_id)

                "

            );

            $prepare = [

                ":brk_id" => 2,
                ":cli_id" => $_POST['cli_id'],
                ":donation_dulan_mnt"=> $_POST['donation_dulan_mnt'],
                ":ptyp_id"=> $_POST['ptyp_id'],
                ":donation_dulan_ts" => date('Y-m-d G:i:s'),
                "cau_id" => '700'
            ];

            $insert = $reqprep->execute($prepare);

        }
    }

    function get_last(){

        $reqprep = $this->bdd->query(
            "SELECT

            asso_donation.don_id as Id_donation_dulan,

            asso_donation.cli_id as Id_Parrain,
            P2.cli_firstname as Prénom,
            P2.cli_lastname as Nom,

            asso_donation.don_mnt as Montant,
            asso_donation.don_ts as Date_creation

            FROM

            asso_donation

            LEFT JOIN crm_client as P2 ON P2.cli_id = asso_donation.cli_id

            WHERE asso_donation.cau_id = 700

            ORDER BY

            asso_donation.don_ts DESC

            LIMIT 0,9
            ");





            //$prepare = [":donation_dulan_ts" => $_GET['donation_dulan_ts']];

            $data = [
                "content"     => $reqprep->fetchAll(\PDO::FETCH_NUM),
                "head"              => ["Id","Id_membre","Prénom","Nom","Montant","Date enregistrement","Action"],
            ];

            return $data;

        }

        function get_donation_dulan_by_member($p_nb_by_page,$p){

            $start = ($p * $p_nb_by_page) - $p_nb_by_page ;

            $reqprep = $this->bdd->prepare(

                "SELECT

                asso_donation.don_id as Id_donation_dulan,

                asso_donation.don_ts as Date_creation,
                asso_donation.don_mnt as Montant


                FROM

                asso_donation

                LEFT JOIN crm_client as P2 ON P2.cli_id = asso_donation.cli_id

                WHERE P2.cli_id = :cli_id

                AND asso_donation.cau_id = 700

                ORDER BY

                asso_donation.don_ts DESC

                LIMIT $start,$p_nb_by_page

                ");

                $prepare = [
                    ":cli_id" => $_GET['cli_id']
                ];

                $reqprep->execute($prepare);

                $count_reqprep = $this->bdd->prepare("SELECT COUNT(don_id) FROM asso_donation WHERE cau_id= 700 and cli_id = :cli_id ");

                $count_prepare = [
                    ":cli_id" => $_GET['cli_id']
                ];

                $count_reqprep->execute($count_prepare );

                $count_return = $count_reqprep->fetch(\PDO::FETCH_NUM);

                $return = [
                    "content" => $reqprep->fetchAll(\PDO::FETCH_NUM),
                    "head" => ["id","Date création","Montant","Action"],
                    "count" => $count_return[0]
                ];

                    return $return ;

                }



                function get_list(){

                    $where = '';

                    $param_request = $this->Get_param_request();

                    foreach ($param_request[0] as $key => $value) {
                        if($value != ''){

                            switch (substr($key,0,3)) {

                                case 'adh':
                                $key_table = 'asso_donation_dulan.'.$key;// code...
                                break;
                                case 'cli':
                                $key_table = 'P2.'.$key;// code...
                                break;

                            }

                            $where .= ' AND '.$key_table.' LIKE :'.$key ;


                        }
                    }


                    if (isset($param_request[1]) && ($param_request[1] != 'get')){$filter = (($param_request[1])-1)*10;}else{$filter = 0;}


                    $reqprep = $this->bdd->prepare(
                        "SELECT

                        asso_donation.don_id as Id_donation_dulan,

                        asso_donation.cli_id as Id_Parrain,
                        P2.cli_firstname as Prénom,
                        P2.cli_lastname as Nom,

                        asso_donation.don_mnt as Montant,
                        asso_donation.don_ts as Date_creation,

                        P4.rec_number as Receipt

                        FROM

                        asso_donation

                        LEFT JOIN crm_client as P2 ON P2.cli_id = asso_donation.cli_id
                        LEFT JOIN asso_receipt_donation as P3 ON P3.don_id = asso_donation.don_id
                        LEFT JOIN asso_receipt as P4 ON P4.rec_id = P3.rec_id


                        WHERE

                        asso_donation.cau_id='700'

                        $where

                        ORDER BY

                        asso_donation.don_ts DESC

                        LIMIT $filter,10

                        ");

                        $count_reqprep = $this->bdd->prepare("SELECT COUNT(don_id) FROM asso_donation WHERE cau_id='700' $where ");

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
                            "list_donation_dulan"     => $reqprep->fetchAll(\PDO::FETCH_NUM),
                            "head"              => ["Id","Id_membre","Prénom","Nom","Montant","Date enregistrement"],
                            "count"             => $count_result
                        ];

                        return $data;
                    }

                    function get_list_export(){

                        $where = '';

                        $param_request = $this->Get_param_request();

                        foreach ($param_request[0] as $key => $value) {
                            if($value != '' && $key != 'export_name' ){

                                switch (substr($key,0,3)) {

                                    case 'adh':
                                    $key_table = 'asso_donation_dulan.'.$key;// code...
                                    break;
                                    case 'cli':
                                    $key_table = 'P2.'.$key;// code...
                                    break;

                                }

                                $where .= ' AND '.$key_table.' LIKE :'.$key ;

                            }
                        }

                        $reqprep = $this->bdd->prepare(

                            "SELECT

                            asso_donation.don_id as Id_donation_dulan,

                            asso_donation.cli_id as Id_Parrain,
                            P2.cli_firstname as Prénom,
                            P2.cli_lastname as Nom,

                            asso_donation.don_mnt as Montant,
                            asso_donation.don_ts as Date_creation,

                            P4.rec_number as Receipt

                            FROM

                            asso_donation

                            LEFT JOIN crm_client as P2 ON P2.cli_id = asso_donation.cli_id
                            LEFT JOIN asso_receipt_donation as P3 ON P3.don_id = asso_donation.don_id
                            LEFT JOIN asso_receipt as P4 ON P4.rec_id = P3.rec_id


                            WHERE

                            asso_donation.cau_id='700'

                            $where

                            ORDER BY

                            asso_donation.don_ts DESC

                            ");


                            $reqprep->execute();

                            $data = [
                                "content"     => $reqprep->fetchAll(\PDO::FETCH_NUM),
                                "head"              => ["Id","Id_membre","Prénom","Nom","Montant","Date enregistrement"],
                                                        ];

                            return $data;
                        }

                    public function delete()
                    {
                        $reqprep = $this->bdd->prepare(
                            "DELETE FROM asso_donation
                            WHERE don_id = :don_id ");
                            $prepare = [":don_id" => $_GET["donation_dulan_id"]];

                            $reqprep->execute($prepare);

                            header("Location: ".$_SERVER['HTTP_REFERER']);

                        }

                        public function update(){

                            $reqprep = $this->bdd->prepare(

                                "UPDATE asso_donation

                                SET
                                cli_id     = :cli_id,
                                don_mnt    = :don_mnt,
                                ptyp_id    = :ptyp_id

                                WHERE   cau_id = '700'
                                AND     don_id = :don_id "
                            );

                            $prepare = [
                                ":cli_id" => $_POST["cli_id"],
                                ":don_mnt" => $_POST["donation_dulan_mnt"],
                                ":ptyp_id" => $_POST["ptyp_id"],
                                ":don_id" => $_GET["don_id"]
                            ];

                            $reqprep->execute($prepare);

                            switch ($_GET["from"]) {
                                case 'add':
                                header("Location: http://localhost:8888/www/Kalaweit/asso_donation_dulan/add");
                                break;

                                case 'get':
                                header( "Location: http://localhost:8888/www/Kalaweit/member/get?cli_id=".$_POST['cli_id']);
                                break;

                                default:
                                header("Location: http://localhost:8888/www/Kalaweit/asso_donation_dulan/list/1");
                                break;
                            }

                        }

                        public function get()
                        {
                            $reqprep = $this->bdd->prepare("SELECT * FROM asso_donation WHERE don_id = :don_id AND cau_id='700'");


                            $prepare = [ ":don_id" => $_GET['donation_dulan_id'] ];

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

                                $sum = $this->bdd->query("SELECT COUNT(don_mnt) FROM asso_donation WHERE cau_id='700' AND YEAR(don_ts)= $year AND MONTH(don_ts)= $i ");

                                array_push($data,$sum->fetch(\PDO::FETCH_NUM ));

                            }

                            return $data;

                        }
                        public function get_chart_data_sum($year){

                            $begin = $year.'-01-01 00:00:00';
                            $end = $year.'-12-31 23:59:59';

                            $data = [];

                            for ($i=1; $i < 13; $i++) {

                                $sum = $this->bdd->query("SELECT SUM(don_mnt) FROM asso_donation WHERE cau_id='700' AND YEAR(don_ts)= $year and MONTH(don_ts)= $i ");

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

                                $sum = $this->bdd->query("SELECT SUM(don_mnt) FROM asso_donation WHERE cau_id='700' AND YEAR(don_ts)= $year and MONTH(don_ts)= $i ");

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

                                $sum = $this->bdd->query("SELECT COUNT(don_mnt) FROM asso_donation WHERE cau_id='700' AND YEAR(don_ts)= $year and MONTH(don_ts)= $i ");

                                $temp = $sum->fetch(\PDO::FETCH_NUM );

                                $data[] = $temp[0];
                            }

                            return $data;

                        }



                    }
