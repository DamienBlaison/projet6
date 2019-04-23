<?php
namespace Kalaweit\Manager;

/**
 * Ile manager
 *
 * @author jeromeklam
 */
class Cli_lang
{

    /**
     * Retourne toutes les langues
     *
     * @return array(\Kalaweit\Model\Langue)
     */

     public function getAll()
     {
        // $ret    = [];
         $config = \Kalaweit\Core\Config::getInstance();
         $cli_lang   = $config->get('cli_lang');

         //foreach ($cli_lang as $key => $value) {
             //$ret[] = new \Kalaweit\Model\Cli_lang($key, $value);
            // ($key);
         //}
         return $cli_lang;
     }
}
