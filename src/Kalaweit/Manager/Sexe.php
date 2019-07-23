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
        include( './config/config.php');

        return $config['sexe'];
    }
}
