<?php
namespace Kalaweit\Core;

/**
* Gestion de l'application
* @author jeromeklam
*/
class Application
{

    /**
    * La requête
    * @var \Kalaweit\Core\Request
    */
    protected static $request = null;

    /**
    * Config
    * @var \Kalaweit\Core\Config
    */
    protected $config = null;

    /**
    * Constructeur
    *
    * @param \Kalaweit\Core\Config $p_config
    */
    public function __construct(\Kalaweit\Core\Config $p_config)
    {
        $this->config = $p_config;
    }

    /**
    * La requête
    */
    protected function getRequest()
    {
        if (self::$request === null) {
            self::$request = \Kalaweit\Core\Request::getInstance();
        }
        return self::$request;
    }

    /**
    * exécution
    */
    public function handle()
    {
        $request = $this->getRequest();
        // Je récupère l'url pour la décomposer et j'enlève le 1er / pour éviter [0] == ''


        $uri     = ltrim($request->getUri(), '/');

        $parts   = explode('?',$uri);
        $parts   = explode('/', $parts[0]);

        if (is_array($parts) && count($parts) > 1) {
            array_shift($parts);

            switch ($parts[0]) {

                case 'Kalaweit':

                // Je construit le nom de la classe pour vérification

                $class = '\\' . ucfirst($parts[0]) . '\\Controller\\' . ucfirst($parts[1]);

                if ($parts[1] == "app_connexion"){

                    if (class_exists($class)) {
                        // J'instancie un nouvel élément de la classe
                        $obj = new $class();

                        switch ($parts[2]) {

                            case 'log_in':
                            if (method_exists($obj, 'log_in')){
                                echo $obj->log_in();
                            };
                            break;

                            case 'log_out':
                            if (method_exists($obj, 'log_out')){
                                echo $obj->log_out();
                            };

                            break;
                            default:

                            header("location:http://localhost:8888/www/Kalaweit/app_connexion/log_in");
                            //echo '404';

                            break;


                        };
                    }
                }

                else

                {

                    if (class_exists($class)) {

                        // J'instancie un nouvel élément de la classe
                        $obj = new $class();

                        switch ($parts[2]) {
                            case 'add':
                            if (method_exists($obj, 'add')){
                                echo $obj->add();
                            };

                            break;

                            case 'get':

                            if (method_exists($obj, 'get')){

                                switch ($parts[1]) {
                                    case 'asso_cause':
                                    echo $obj->get($_GET['cau_id']);
                                    break;
                                    case 'member':
                                    echo $obj->get($_GET['cli_id']);
                                    break;
                                    case 'receipt':
                                    echo $obj->get();
                                    break;

                                    default:

                                    break;
                                };
                            };
                            break;

                            case 'list':
                            if (method_exists($obj, 'get_list')){
                                echo $obj->get_list();
                            };
                            break;

                            case 'update':

                            if (method_exists($obj, 'update')){
                                echo $obj->update();
                            };
                            break;

                            case 'delete':

                            if (method_exists($obj, 'delete')){
                                echo $obj->delete();
                            };

                            break;

                            case 'donation_animal_by_member':

                            if (method_exists($obj, 'donation_animal_by_member')){
                                echo $obj->donation_animal_by_member();
                            };
                            break;

                            case 'donation_forest_by_member':

                            if (method_exists($obj, 'donation_forest_by_member')){
                                echo $obj->donation_forest_by_member();
                            };

                            break;

                            case 'donation_dulan_by_member':

                            if (method_exists($obj, 'donation_dulan_by_member')){
                                echo $obj->donation_dulan_by_member();
                            };

                            break;

                            default:
                            header("location:http://localhost:8888/www/Kalaweit/app_connexion/log_in");
                            //echo '404';

                            break;
                        };
                    };
                }

                break;

                default:
                header("location:http://localhost:8888/www/Kalaweit/app_connexion/log_in");
                //echo '404.1';
                break;
            }
        }

        else

        {
            header("location:http://localhost:8888/www/Kalaweit/app_connexion/log_in");
            echo '404.0';
        }

    }
}
