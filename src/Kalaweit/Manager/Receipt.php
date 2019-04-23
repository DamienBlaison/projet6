<?php namespace Kalaweit\Manager;
/**
 *
 */
class Receipt
{

    function __construct($bdd)
    {
        $this->bdd = $bdd;
    }

    public function get(){

        $reqprep = $this->bdd->prepare(

            "SELECT

            asso_receipt.rec_id,
            asso_receipt.cli_id,
            asso_receipt.rec_year,
            asso_receipt.rec_number,
            asso_receipt.rec_mnt,

            crm_client.cli_firstname,
            crm_client.cli_lastname,
            crm_client.cli_address1,
            crm_client.cli_address2,
            crm_client.cli_address3,
            crm_client.cli_cp,
            crm_client.cli_town,
            crm_client.cnty_id,

            crm_country.cnty_name


            FROM

            asso_receipt

            LEFT JOIN crm_client ON asso_receipt.cli_id = crm_client.cli_id
            LEFT JOIN crm_country ON crm_client.cnty_id = crm_country.cnty_id

            WHERE asso_receipt.rec_id = :rec_id

        ");

        $prepare = [
            ":rec_id" => $_GET["receipt_id"]
        ];

        $reqprep->execute($prepare);

        $return = $reqprep->fetch(\PDO::FETCH_ASSOC);

        return $return;
    }

    function name_receipt($id_don){

        $reqprep = $this->bdd->prepare(
            "   SELECT

                asso_receipt.rec_number

                From asso_receipt_donation

                LEFT JOIN asso_receipt ON asso_receipt_donation.rec_id = asso_receipt.rec_id

                WHERE asso_receipt_donation.don_id = :id_don

            ");

            $prepare = [
                ":id_don" => $id_don
            ];

            $reqprep->execute($prepare);

            return $return = $reqprep->fetch(\PDO::FETCH_ASSOC);


        }
}
