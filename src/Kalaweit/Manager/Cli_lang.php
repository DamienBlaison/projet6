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

        include( './config/config.php');

        return $config['cli_lang'];

     }
}
