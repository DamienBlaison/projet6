<?php  namespace Kalaweit\Manager;

/**
 * Ile manager
 *
 * @author jeromeklam
 */
class Asso_cause_media
{

    /**
     * Retourne toutes les config media
     *
     * @return array(\Kalaweit\Model\media_config)
     */
    public function getAll()
    {
        $ret    = [];
        $config = \Kalaweit\Core\Config::getInstance();
        $config_media   = $config->get('media');

        return $config_media;
    }
}
