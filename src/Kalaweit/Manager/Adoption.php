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

        $config = \Kalaweit\Core\Config::getInstance();
        $adoption   = $config->get('adoption');

        return $adoption;
    }
}
