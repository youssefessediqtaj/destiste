error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'error.log');

spl_autoload_register(function ($class) {
    $path = "model/" . $class . ".php";
    if (file_exists($path)) {
        require_once "$path";
        error_log("Loaded model: $class");
    } else {
        error_log("Failed to load model: $class");
    }
});

$params = explode('/', $_GET['p']);

if (isset($params[0]) & !empty($params[0])) {

    $controller = ucfirst($params[0]);

    if (file_exists("controller/" . $controller . ".php")) {
        require_once 'controller/' . $controller . ".php";
        error_log("Loaded controller: $controller");
        $obj = new $controller();
        if (isset($params[1]) & !empty($params[1])) {
            if (method_exists($obj, $params[1])) {
                $action = $params[1];
                error_log("Calling method: $action");
                if (isset($params[2]) & !empty($params[2])) {
                    $obj->$action($params[2]);
                } else {
                    $obj->$action();
                }
            } else {
                http_response_code(404);
                error_log("Method not found: $params[1]");
                echo "this method doesn't exist";
            }
        } else {
            $action = "index";
            error_log("Calling method: $action");
            $obj->$action();
        }
    } else {
        http_response_code(404);
        error_log("Controller not found: $controller");
        echo "this page doesn't exsit";
    }
} else {
    error_log("No parameters provided");
}<?php

spl_autoload_register(function ($class) {
    $path = "model/" . $class . ".php";
    if (file_exists($path)) {
        require_once "$path";
    }
    
});

$params = explode('/', $_GET['p']);

if (isset($params[0]) & !empty($params[0])) {

    $controller = ucfirst($params[0]);


    if (file_exists("controller/" . $controller . ".php")) {

        require_once 'controller/' . $controller . ".php";
        $obj = new $controller();
        if (isset($params[1]) & !empty($params[1])) {
            if (method_exists($obj, $params[1])) {
                $action = $params[1];
                
                if (isset($params[2]) & !empty($params[2])) {
                    $obj->$action($params[2]);
                } else {
                    $obj->$action();
                }
            } else {
                http_response_code(404);
                echo "this method doesn't exist";
            }
        } else {
            $action = "index";
            $obj->$action();
        }
    } else {
        http_response_code(404);
        echo "this page doesn't exsit";
    }
}

?>