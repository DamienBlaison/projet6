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
        $ret    = [];
        $config = \Kalaweit\Core\Config::getInstance();
        $year   = $config->get('year');

        return $year;
    }
}
