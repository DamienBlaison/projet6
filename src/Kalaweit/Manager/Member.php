<?php

namespace Kalaweit\Manager;

/**
* class des animaux
* blaison Kalaweit
*/

class Member
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

    /**
    * définition des getters()
    */

    public function set_bdd(PDO $bdd){
        $this->bdd = $bdd;
    }

    public function get_list(){


        $param_request = $this->get_param_request();


        //if(isset($param_request[0]['p'])){$filter = $param_request[0]['p'];} else {$filter=0;}

        //if(!isset($_GET["p"])){$filter = 1;} else { $filter = (($_GET["p"])*15)-15;};

        $url = explode('?',$_SERVER['REQUEST_URI']);

        $slice_url = explode('/',$url[0]);

        $page = array_pop($slice_url);

        if($page == 1){ $filter = 0 ;} else { $filter = (($page - 1) * 12); };

        $where = '';
        $prepare =[];

        if(isset($param_request[0])){

          foreach ($param_request[0] as $key => $value) {
                if($value != ''){
                    $where .= ' AND '.$key.' LIKE :'.$key ;
                    $prepare = array_merge($prepare,[':'.$key => '%'.$_GET["$key"].'%']);

                }
            }

        }

        $reqprep = $this->bdd->prepare(

            "SELECT cli_id,cli_lastname,cli_firstname,cli_cp,cli_town
            FROM crm_client
            WHERE 1=1 $where
            ORDER BY cli_lastname
            LIMIT $filter,12

            ");

            $count_reqprep = $this->bdd->prepare(

                "SELECT COUNT(cli_id)
                FROM crm_client
                WHERE 1=1 $where
                ");

                $reqprep->execute($prepare);
                $count_reqprep->execute($prepare);


                $data = [
                    "list_member"   => $reqprep->fetchAll(\PDO::FETCH_NUM),
                    "head"          => ["Id","Nom","Prénom","Cp","Ville"],
                    "count"         => $count_reqprep->fetch(\PDO::FETCH_NUM)
                ];

            return $data;

        }

            function add($member){

                if(isset($_POST["cli_firstname"])){

                    $array_param_post = $this->Get_param_post_add_member();

                    $into_cli       = $array_param_post["array_param_post_cli"]['p_into_cli'];
                    $set_cli        = $array_param_post["array_param_post_cli"]['p_set_cli'];
                    $prepare_cli    = $array_param_post["array_param_post_cli"]["p_prepare_cli"];

                    $reqprep = $this->bdd->prepare("INSERT INTO crm_client ($into_cli) VALUES ($set_cli)");

                    $reqprep->execute($prepare_cli);

                    $query = $this->bdd->query("SELECT MAX(cli_id) FROM crm_client");

                    $id_client = $query->fetch(\PDO::FETCH_NUM);
                    $id_client = $id_client[0];

                    foreach ($array_param_post["array_param_post_clid"] as $key => $value) {

                        $clitd_id = $value["clitd_id"];
                        $cld_valc = $value["cld_valc"];

                        $reqprep_data = $this->bdd->prepare("INSERT INTO crm_client_data (cli_id, clitd_id, cld_valc) VALUES (:id_client, :clitd_id, :cld_valc)");

                        $prepare_data = [

                            ":id_client" => $id_client,
                            ":clitd_id"  => $clitd_id,
                            ":cld_valc"  => $cld_valc
                        ];

                        $reqprep_data->execute($prepare_data);
                    }

                    $redirect = "Location: http://localhost:8888/www/Kalaweit/member/get?cli_id=".$id_client;

                    header($redirect);

                }
            }

            function update($member){

                $array_param_post = $this->get_param_post_update_member();

                $set_cli_array_key = [];
                $set_cli_array_key = explode(",",$array_param_post["array_param_post_cli"]["p_into_cli"]);
                $set_cli_array_value = [];
                $set_cli_array_value = explode(",",$array_param_post["array_param_post_cli"]["p_set_cli"]);

                $count = count($set_cli_array_key) - 1;

                $set = '';
                $prepare = [];

                for ($i=0; $i < $count ; $i++) {

                    $set        .= $set_cli_array_key[$i]." = ".$set_cli_array_value[$i]." , ";

                }

                $set = rtrim($set,", ");

                $prepare =  array_merge($array_param_post["array_param_post_cli"]["p_prepare_cli"],[":cli_id"=>$_GET['cli_id']]);

                $reqprep = $this->bdd->prepare("UPDATE crm_client SET $set WHERE cli_id = :cli_id");

                $reqprep->execute($prepare);

                foreach ($array_param_post["array_param_post_clid"] as $key => $value) {

                    $reqprep_data = $this->bdd->prepare("UPDATE crm_client_data SET cld_valc = :cld_valc WHERE cli_id = :cli_id AND clitd_id = :clitd_id");

                    $prepare_data = [":cld_valc" =>$value["cld_valc"], ":cli_id" => $_GET['cli_id'], "clitd_id" => $value["clitd_id"] ] ;

                    $reqprep_data->execute($prepare_data);

                }

            }


            function get($member,$id){


                if(isset($_POST['cli_lastname'])){$this->update($id);}

                $reqprep = $this->bdd->prepare(

                    "SELECT

                    crm_client.cli_id, crm_client.brk_id , crm_client.clic_id , crm_client.clit_id , crm_client.cli_gender ,
                    crm_client.cli_firstname , crm_client.cli_lastname , crm_client.cli_address1 , crm_client.cli_address2 ,
                    crm_client.cli_address3 , crm_client.cli_cp , crm_client.cli_town , crm_client.cnty_id , crm_client.cli_active ,
                    crm_client.cli_lang , crm_client.cli_prefs , crm_client.cli_avatar,

                    D1.cld_valc as clitd_1, D2.cld_valc as clitd_2, D3.cld_valc as clitd_3, D4.cld_valc as clitd_4

                    FROM crm_client

                    LEFT JOIN crm_client_data as D1 on D1.cli_id = crm_client.cli_id and D1.clitd_id = 1
                    LEFT JOIN crm_client_data as D2 on D2.cli_id = crm_client.cli_id and D2.clitd_id = 2
                    LEFT JOIN crm_client_data as D3 on D3.cli_id = crm_client.cli_id and D3.clitd_id = 3
                    LEFT JOIN crm_client_data as D4 on D4.cli_id = crm_client.cli_id and D4.clitd_id = 4

                    WHERE crm_client.cli_id = :cli_id

                    ");

                    $prepare = [':cli_id' => $id ];

                    $member = $reqprep->execute($prepare);

                    $member = $reqprep->fetch(\PDO::FETCH_ASSOC);

                    return $member;

                }

                function get_select(){

                    $reqprep = $this->bdd->query("SELECT cli_id, cli_lastname, cli_firstname FROM crm_client ORDER BY cli_lastname");


                    $return = [];

                    foreach ($reqprep->fetchALL() as $key => $value){

                        $cli_loop = ["cli_id" => $value["cli_id"],"cli_identity"=> $value["cli_lastname"]." ".$value["cli_firstname"]];



                        $return []= $cli_loop;

                    }

                    return $return;

                }

                function get_all(){

                    $reqprep = $this->bdd->query("SELECT cli_id,cli_lastname,cli_firstname,cli_cp,cli_town FROM crm_client ORDER BY cli_id LIMIT 0,15");
                    $reqprep->execute();
                    $return = $reqprep->fetchAll(\PDO::FETCH_NUM);
                    return $return;
                }

                function get_count(){

                    $reqprep = $this->bdd->query("SELECT Count(cli_id) FROM crm_client");
                    $reqprep->execute();
                    $count_member = $reqprep->fetch();
                    return $count_member;


                }
            }
