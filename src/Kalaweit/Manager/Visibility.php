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

        $config = \Kalaweit\Core\Config::getInstance();

        $visibility  = $config->get('visibility');

        return $visibility;
    }
}
