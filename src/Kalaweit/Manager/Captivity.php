<?php  namespace Kalaweit\Manager;

/**
 * Ile manager
 *
 * @author jeromeklam
 */
class Captivity
{

    /**
     * Retourne toutes les îles
     *
     * @return array(\Kalaweit\Model\Ile)
     */
    public function getAll()
    {

        include( './config/config.php');

        return $config['captivity'];
        
    }
}
