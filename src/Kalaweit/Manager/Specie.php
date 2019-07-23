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

         include( './config/config.php');

         return $config['especes'];

     }
}
