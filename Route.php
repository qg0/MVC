<?php

class Route
{
    static function start()
    {
        $controller_name = $_GET['controller'] ? $_GET['controller'] : 'default';
        $action_name     = $_GET['action'] ? $_GET['action'] : 'index';

        $controller_name = $controller_name.'Controller';
        $action_name     = $action_name.'Action';

        $controller_file = ucfirst($controller_name).'.php';
        $controller_path = "Controllers/".$controller_file;

        if(file_exists($controller_path))
        {
            include "Controllers/".$controller_file;
        }
        else
        {
            Route::ErrorPage404();
        }

        $controller = new $controller_name;
        $action     = $action_name;

        if(method_exists($controller, $action))
        {
            $controller->$action();
        }
        else
        {
            Route::ErrorPage404();
        }
    }

    static function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404.html');
    }

}
