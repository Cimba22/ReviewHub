<?php


require_once 'src/controller/DefaultController.php';
require_once 'src/controller/SecurityController.php';
require_once 'src/controller/CategoryController.php';
require_once 'src/controller/ReviewController.php';


class Routing {

    public static $routes;

    public static function get($url, $view): void
    {
        self::$routes[$url] = $view;
    }

    public static function post($url, $view): void
    {
        self::$routes[$url] = $view;
    }

    public static function run ($url): void
    {
        $action = explode("/", $url)[0];
        if (!array_key_exists($action, self::$routes)) {

            die("Wrong url!");
        }

        $controller = self::$routes[$action];
        $object = new $controller;
        $action = $action ?: 'index';

        $object->$action();
    }
}