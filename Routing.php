<?php
class Routing {

    public static function get($url, $controller) {
        self::$routes[$url] = $controller;
    }

    public static function run($url) {
        $action = explode('/', $url)[0];

        if(!array_key_exists)
    }
}