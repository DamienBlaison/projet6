<?php  namespace Kalaweit\Manager;

/**
 * Ile manager
 *
 * @author jeromeklam
 */
class Adoption
{

    /**
     * Retourne toutes les îles
     *
     * @return array(\Kalaweit\Model\Adoption)
     */
    public function getAll()
    {

        include( './config/config.php');

        return $config['adoption'];
    }
}
