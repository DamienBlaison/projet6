<?php
include ('../vendor/autoload.php');

/**
 * Le fichier php qui permet d'intégrer toutes les sources dont l'autoloader
 * Le but de l'autoloader est de ne plus avoir besoin de faire de include, require
 * Par contre il faut préfixer les classes par le chemin
 */

session_start();


/**
 * Récupération de la configuration
 * C'est l'autoloader qui va inclure le fichier
 * On utilise son chemin
 */

$config = \Kalaweit\Core\Config::getInstance(__DIR__ . '/../config/config.php');

/**
 * On instancie une application qui va se charger de tout gérer, on lui passe la config locale
 * @var \Kalaweit\Core\Application $application
 */

$application = new \Kalaweit\Core\Application($config);

/**
 * Lancement autour d'une exception pour gérer les erreurs
 */

try {
    /**
     * La classe application va se charger du tout...
     */

    $application->handle();

} catch (\Exception $ex) {
    ($ex);
}
