<?php  namespace Kalaweit\Manager;

/**
 * Ile manager
 *
 * @author jeromeklam
 */
class Visibility
{

    /**
     * Retourne toutes les îles
     *
     * @return array(\Kalaweit\Model\Vidsibility)
     */
    public function getAll()
    {

        include( './config/config.php');

        return $config['visibility'];
    }
}
