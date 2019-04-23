<?php  namespace Kalaweit\Manager;

/**
 * Ile manager
 *
 * @author jeromeklam
 */
class Sexe
{

    /**
     * Retourne toutes les îles
     *
     * @return array(\Kalaweit\Model\Sexe)
     */
    public function getAll()
    {
        $ret    = [];
        $config = \Kalaweit\Core\Config::getInstance();
        $sexe   = $config->get('sexe');

        return $sexe;
    }
}
