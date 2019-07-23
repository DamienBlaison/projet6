<?php  namespace Kalaweit\Manager;

/**
 * Ile manager
 *
 * @author jeromeklam
 */
class Year
{

    /**
     * Retourne toutes les îles
     *
     * @return array(\Kalaweit\Model\Year)
     */
    public function getAll()
    {
        include( './config/config.php');

        return $config['year'];
    }
}
