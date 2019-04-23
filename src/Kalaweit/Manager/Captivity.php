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

        $config = \Kalaweit\Core\Config::getInstance();
        $captivity  = $config->get('captivity');

        return $captivity;
    }
}
