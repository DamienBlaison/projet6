<?php  namespace Kalaweit\Manager;

class Gender
{

    public function getAll()
    {
        $ret    = [];
        $config = \Kalaweit\Core\Config::getInstance();
        $gender   = $config->get('gender');

        return $gender;
    }
}
