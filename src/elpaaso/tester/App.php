<?php
/**
 * Copyright (C) 2014 Orange
 *
 * This software is distributed under the terms and conditions of the 'MIT'
 * license which can be found in the file 'LICENSE' in this package distribution
 * or at 'http://opensource.org/licenses/MIT'.
 *
 * Author: Arthur Halet
 * Date: 17/07/2014
 */


namespace elpaaso\tester;

use elpaaso\tester\extforplate\GlobalExtension;
use FastRoute;

/**
 * Class App
 * @package elpaaso\tester
 */
class App
{
    /**
     * @var array
     */
    public static $TESTS_MENU = array();
    /**
     * @var App
     */
    private static $_instance;
    /**
     * @var
     */
    private $routes;
    /**
     * @var \League\Plates\Template
     */
    private $template;
    /**
     * @var string
     */
    private $routeJson = 'routes.json';

    /**
     *
     */
    private function __construct()
    {

        $engine = new \League\Plates\Engine(ROOT . '/templates');
        $engine->loadExtension(new GlobalExtension());
        $this->template = new \League\Plates\Template($engine);
        $this->loadRouteFile();
        ksort($_ENV);
    }

    /**
     *
     */
    public function loadRouteFile()
    {
        $this->routes = json_decode(file_get_contents(ROOT . '/routes.json'), true);
        $folderTest = new \Arhframe\Util\Folder(ROOT . '/controller/tests');
        $filesTest = $folderTest->getFiles('#.*\.php$#i');
        App::$TESTS_MENU = array();

        foreach ($filesTest as $fileTest) {
            $routeFromTest = array();
            $routeFromTest['method'] = 'GET';
            App::$TESTS_MENU[] = $fileTest->getBase();
            if ($this->routeAlreadyExist('/' . $fileTest->getBase())) {
                continue;
            }

            $routeFromTest['route'] = '/' . $fileTest->getBase();
            $routeFromTest['controller'] = 'tests/' . $fileTest->getName();
            $this->routes[] = $routeFromTest;
        }
        file_put_contents(ROOT . '/routes.json', json_encode($this->routes));
    }

    /**
     * @param $search
     * @return bool
     */
    private function routeAlreadyExist($search)
    {
        foreach ($this->routes as $route) {
            if ($route['route'] == $search) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return App
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    /**
     * @return bool
     */
    public static function isInCloudFoundry()
    {
        if (!empty($_ENV['VCAP_APPLICATION'])) {
            return true;
        }
        return false;
    }

    public static function appName()
    {
        if (empty($_ENV['VCAP_APPLICATION'])) {
            return "cloud-php-sample-portal";
        }
        $vcapApplication = json_decode($_ENV["VCAP_APPLICATION"], true);
        return $vcapApplication["name"];
    }

    public static function instanceId()
    {
        if (empty($_ENV['VCAP_APPLICATION'])) {
            return "instance-local";
        }
        $vcapApplication = json_decode($_ENV["VCAP_APPLICATION"], true);
        return $vcapApplication["instance_id"];
    }

    /**
     *
     */
    public function start()
    {
        // for use http basic auth with php-fpm
        if (!empty($_SERVER['HTTP_AUTHORIZATION'])) {
            list($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) = explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));
        }
        // --
        global $routes;
        $routes = $this->routes;
        $dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
            global $routes;
            foreach ($routes as $route) {
                $r->addRoute($route['method'], $route['route'], $route['controller']);
            }
        });

        $routeInfo = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['PATH_INFO']);
        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                echo $this->template->render('404');
                break;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                echo $this->template->render('405');
                break;
            case FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $_VARS = $routeInfo[2];
                $template = $this->template;
                include_once ROOT . '/controller/' . $handler;
                break;
        }
    }

} 