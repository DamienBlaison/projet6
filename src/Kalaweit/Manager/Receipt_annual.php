<?php namespace Kalaweit\Manager;
/**
*
*/
class Receipt_annual
{

    use \Kalaweit\Transverse\Get_param_request;

    function __construct($bdd)
    {
        $this->bdd = $bdd;
    }

    public function add(){

        $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();

        // indexation des numeros de recus

        $member = (new \Kalaweit\Model\Member());
        $cli_info = (new \Kalaweit\Manager\Member($bdd))->get($member,$_GET["cli_id"]);
        $country = (new \Kalaweit\Manager\Crm_country())->get($bdd,$cli_info["cnty_id"]);

        $receipt_details = (new \Kalaweit\Manager\Receipt($bdd))->details_donations_year_by_member($_GET["cli_id"]);
        $receipt_resume = (new \Kalaweit\Manager\Receipt($bdd))->resume_donations_year_by_member($_GET["cli_id"]);

        /* initialisation de tableaux avec la traduction des elements en francais à afficher */

        $mois = array('','janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
        $jours = array('dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi');

        $suffixe = '_'.$cli_info["cli_firstname"].'_'.$cli_info["cli_lastname"];

        $req = "SELECT MAX(rec_number) FROM asso_receipt WHERE rec_number LIKE 'RF_%'";

        $prefixe = "RF_".date('Y')."_";

        $rec_number = ($this->bdd->query($req));

        $receipt_number = $rec_number->fetch(\PDO::FETCH_NUM);

        if($receipt_number[0] != NULL){

            $max = explode('_',$receipt_number[0]);

            $receipt_num = intval($max[2]);

        } else { $receipt_num = 1000; };


        $insert = $this->bdd->prepare(" INSERT INTO asso_receipt (brk_id,cli_id,rec_ts,rec_year,rec_number,rec_mnt) VALUES (2,:cli_id,:rec_ts,:rec_year,:rec_number,:rec_mnt)");

        $receipt_num_to_insert = $receipt_num + 1;

        $rec_number = $prefixe.$receipt_num_to_insert.$suffixe;

        $prepare2 =[

            ":cli_id" => $_GET["cli_id"],
            ":rec_ts" => date('Y-m-d G:i:s'),
            ":rec_year" => date('Y'),
            ":rec_number" => $rec_number,
            ":rec_mnt" => $receipt_resume[0]["sum(don_mnt)"]
        ];
        //echo'<pre>';
        //var_dump($prepare2);

        //echo'</pre>';

        $insert->execute($prepare2);

        $content = [
            "cli_info" => $cli_info,
            "receipt_details" => $receipt_details,
            "resume" => $receipt_resume,
            "receipt_number" => $rec_number,
            "date" =>  $jours[date('w')].' '.date('j').' '.$mois[date('n')].' '.date('Y'),
            "country" => $country
        ];

            return (new \Kalaweit\View\Receipt\Receipt_annual($content))->render("open");

    }
}
