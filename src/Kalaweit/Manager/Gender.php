<?php  namespace Kalaweit\Manager;

class Gender
{

    public function getAll()
    {
        include( './config/config.php');

        return $config['gender'];
    }
}
