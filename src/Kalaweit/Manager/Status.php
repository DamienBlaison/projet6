<?php
namespace Kalaweit\Manager;

/**
 * Ile manager
 *
 * @author jeromeklam
 */
class Status
{

    /**
     * Retourne toutes les langues
     *
     * @return array(\Kalaweit\Model\Status)
     */

     public function getAll()
     {
         include( './config/config.php');

         return $config['status'];
     }
}
