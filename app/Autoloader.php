<?php

namespace App;

use Exception;

class Autoloader{
    public function __construct()
    {
        spl_autoload_register(function ($class_name) {
            $class_name = str_replace("App", "app", $class_name);

            $path = BASE_PATH . DIRECTORY_SEPARATOR . str_replace("\\", DIRECTORY_SEPARATOR, $class_name) . ".php";

            if ( @file_exists($path) ){
                include $path;
            } else {
                die($path);
            }
        });        
    }

    /**
     * Load application
     *
     * @return void
     */
    public function load()
    {
        if( config("database.selected") ){
            Widgets::getInstance()->load();
        }
        
        if ( file_exists(BASE_PATH . "/config-install.php") ) {
            require BASE_PATH . "/steamauth/steamauth.php";
        }
        
        $this->loadRoutes();
    }

    /**
     * Load all routes of application
     *
     * @return void
     */
    public function loadRoutes()
    {
        require_once BASE_PATH . "/routes/web.php";

        $match = $router->match();

        if ($match === false) {
            echo "Not found";
        } else {
            $GLOBALS["title"] = $match["name"]; 
            $target = $match["target"]; 
            $_GET = array_merge($_GET, $match["params"]);
        
            list( $controller, $action ) = explode("@", $target);
        
            $controller = "App\Controllers\\$controller";

            // if ( is_callable(array($controller, $action)) ) {
            if ( method_exists($controller, $action) ) {
                $installed = Middleware\InstallMiddleware::handle();
                
                if( $installed ){
                    Middleware\LoginMiddleware::handle();
                }

                $controller = new $controller;

                echo call_user_func_array(array($controller,$action), array($match['params']));
            } else {
                throw new Exception("Controller or action not found");
            }
        }             
    }
}