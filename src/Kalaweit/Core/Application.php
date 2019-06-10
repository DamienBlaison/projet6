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

                            header("location:/www/Kalaweit/app_connexion/log_in");
                            //echo '404';

                            break;


                        };
                    }

                    else
                    {
                        header("location:/www/Kalaweit/app_connexion/log_in");
                    }
                }

                else

                {

                    if (class_exists($class)) {

                        // J'instancie un nouvel élément de la classe
                        $obj = new $class();

                        switch ($parts[2]) {

                            case 'generate':

                            if (method_exists($obj, 'generate')){
                                echo $obj->generate();
                            };

                            break;

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
                                    case 'dashboard':
                                    echo $obj->get();
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

                            case 'donation_by_member':

                            if (method_exists($obj, 'donation_by_member')){
                                echo $obj->donation_by_member();
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

                            case 'asso_cause_donation':

                            if (method_exists($obj, 'asso_cause_donation')){
                                echo $obj->asso_cause_donation();
                            };

                            case 'export_excel':

                            if (method_exists($obj, 'export_excel')){
                                echo $obj->export_excel($parts[3]);
                            };

                            break;

                            case 'crop':

                            if (method_exists($obj, 'crop')){
                                echo $obj->crop();
                            };
                            break;

                            case 'upload_avatar':

                            if (method_exists($obj, 'upload_avatar')){
                                echo $obj->upload_avatar();
                            };
                            break;

                            case 'upload_photo1':

                            if (method_exists($obj, 'upload_photo1')){
                                echo $obj->upload_photo1();
                            };
                            break;

                            case 'upload_photo2':

                            if (method_exists($obj, 'upload_photo2')){
                                echo $obj->upload_photo2();
                            };
                            break;

                            default:

                            header("location:/www/Kalaweit/app_connexion/log_in");
                            echo '404';

                            break;
                        };
                    }

                    else

                    {
                        header("location:/www/Kalaweit/app_connexion/log_in");
                    };
                }

                break;

                default:


                $class = '\\Site\\Controller\\' . ucfirst($parts[0]);

                if (class_exists($class))

                {
                    $obj = new $class();

                    switch ($parts[0]) {

                        case 'home';

                        if (method_exists($obj, 'render')){
                            echo $obj->render();
                        };

                        break;

                        case 'Gibbon_gallery';

                        if (method_exists($obj, 'render')){
                            echo $obj->render();
                        };

                        break;

                        case 'Gibbon';

                        if (method_exists($obj, 'render')){
                            echo $obj->render();
                        };

                        break;

                        case 'Gibbons';

                        if (method_exists($obj, 'render')){
                            echo $obj->render();
                        };

                        break;
                        case 'History';

                        if (method_exists($obj, 'render')){
                            echo $obj->render();
                        };

                        break;
                        case 'Team';

                        if (method_exists($obj, 'render')){
                            echo $obj->render();
                        };

                        break;
                        case 'Deforestation';

                        if (method_exists($obj, 'render')){
                            echo $obj->render();
                        };

                        break;

                        case 'Context';

                        if (method_exists($obj, 'render')){
                            echo $obj->render();
                        };

                        break;

                        case 'Palm_oil';

                        if (method_exists($obj, 'render')){
                            echo $obj->render();
                        };

                        break;
                        case 'Borneo';

                        if (method_exists($obj, 'render')){
                            echo $obj->render();
                        };

                        break;
                        case 'Sumatra';

                        if (method_exists($obj, 'render')){
                            echo $obj->render();
                        };

                        break;
                        case 'Friends';

                        if (method_exists($obj, 'render')){
                            echo $obj->render();
                        };

                        break;

                        case 'Gift';

                        if (method_exists($obj, 'render')){
                            echo $obj->render();
                        };

                        break;

                        case 'Gift_forest';

                        if (method_exists($obj, 'render')){
                            echo $obj->render();
                        };

                        break;

                        case 'Gift_dulan';

                        if (method_exists($obj, 'render')){
                            echo $obj->render();
                        };

                        break;


                    }

                }

                else

                {
                    header("location:/www/home");
                    echo '404.1';
                };

                break;
            }
        }

        else

        {
            header("location:/www/home");
            echo '404.0';
        }

    }
}
