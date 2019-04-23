<?php
namespace Kalaweit\Manager;

/**
 * Ile manager
 *
 * @author jeromeklam
 */
class Crm_country
{

    /**
     * Retourne tous les pays
     *
     * @return array(\Kalaweit\Model\country)
     */


     public function getAll(\PDO $bdd){

        $country = $bdd->query("SELECT * FROM crm_country");

        $country  = $country ->fetchAll(\PDO::FETCH_ASSOC);

        return $country ;
     }
}
