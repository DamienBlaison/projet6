<?php  namespace Kalaweit\Manager;

/**
 * Ile manager
 *
 * @author jeromeklam
 */
class Ile
{

    /**
     * Retourne toutes les îles
     *
     * @return array(\Kalaweit\Model\Ile)
     */
    public function getAll()
    {
        $ret    = [];
        $config = \Kalaweit\Core\Config::getInstance();
        $iles   = $config->get('islands');

        return $iles;
    }
}
