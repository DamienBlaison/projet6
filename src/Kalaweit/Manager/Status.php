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
        // $ret    = [];
         $config = \Kalaweit\Core\Config::getInstance();
         $status   = $config->get('status');

         //foreach ($cli_lang as $key => $value) {
             //$ret[] = new \Kalaweit\Model\Cli_lang($key, $value);
            // ($key);
         //}
         return $status;
     }
}
