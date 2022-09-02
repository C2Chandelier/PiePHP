<?php

namespace Core;

use Core\Router;
use Core\ORM;

class Core
{

    public function run()
    {
        echo __CLASS__ . "[OK]" . PHP_EOL;
        $url = substr($_SERVER['REQUEST_URI'], 7);
        require_once('./Core/Router.php');
        require_once('./src/routes.php');

        $class = Router::get($url)['Controller'] . 'Controller';
        $run = new $class();
        $action = Router::get($url)['action'];
        $run->$action();
    }

    public function run_dyn()
    {
        $url = substr($_SERVER['REQUEST_URI'], 8);

        if ($url != "") {
            $array = explode('/', $url);
            if (count($array) == 2) {
                $controller = $array[0];
                $action = $array[1];
            } elseif (count($array) == 1) {
                $controller = $array[0];
                $action = 'index';
            }
        } else {
            $controller = 'App';
            $action = 'index';
        }



        $file = './src/Controller/' . $controller . 'Controller.php';

        if (file_exists($file)) {
            if($action == ""){
                $action = "index";
            }
            if (method_exists($controller . 'Controller', $action)) {
                $class = $controller . 'Controller';
                $run = new $class();
                $run->$action();
            } else {
                echo "404 method";
            }
        }
        else{
            echo "404 controller";
        }
        
    }

    public function testORM(){
        $app = new ORM;
        var_dump($app->find('users',[]));
    }
}
