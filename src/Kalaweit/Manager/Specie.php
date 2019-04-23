<?php
namespace Kalaweit\Manager;

/**
 * Ile manager
 *
 * @author jeromeklam
 */
class Specie
{

    /**
     * Retourne toutes les especes
     *
     * @return array(\Kalaweit\Model\Specie)
     */


     public function getAll()
     {

         $config = \Kalaweit\Core\Config::getInstance();
         $specie   = $config->get('especes');

         return $specie;

     }
}
