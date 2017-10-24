<?php
/**
 * Created by PhpStorm.
 * User: didierberlioz
 * Date: 14/10/2017
 * Time: 15:09
 */

namespace AlgoliaTest;


use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Symfony\Component\Yaml\Parser;

class App
{

    private $controller;
    private $action;
    private $config;
    private $routeConfig;
    private $ymlParser;
    private $logger;
    private $routeKey;
    private $root;

    /**
     * App constructor.
     */
    function __construct()
    {
        $this->ymlParser = new Parser();
        $this->root = get_root();

        // create a log channel
        $this->logger = new Logger('algoliatest');
        $this->logger->pushHandler(new StreamHandler($this->root . 'logs/debug.log'));
    }

    /**
     * Main app run method
     */
    public function run()
    {
        try {
            // Get request uri
            $uri = substr($_SERVER['REQUEST_URI'], 1);

            // Read routes config file
            $routes = $this->ymlParser->parse(file_get_contents($this->root . 'config/routes.yml'));

            // Retrieve route information
            list($module, $routeKey, $controller, $action, $routeConfig) = $this->getRouteData($routes, $uri);
            $controller = Constants::CONTROLLER_NAMESPACE_ROOT . '\\' . ucfirst($module) . '\\' . ucfirst($controller);
            $this->controller = $controller;
            $this->action = $action;
            $this->routeConfig = $routeConfig;
            $this->routeKey = $routeKey;

            // Execute controller matching route and action
            $controllerInstance = new $this->controller($this);
            $action = $action . 'Action';
            $controllerInstance->$action();

        } catch (\Exception $e) {
            $this->logger->error('App run error . ' . $e->getMessage());
            include $this->root . 'error/error.php';
        }
    }

    /**
     * Retrieve route data from uri
     * @param $routes
     * @param $uri
     * @return array
     */
    private function getRouteData($routes, $uri)
    {
        // Get controller and action from uri
        $module = 'page';
        $controller = '';
        $action = 'index';
        $routeConfig = null;
        $routeKey = '';
        foreach ($routes as $routeKey => $routeValue) {
            if ($routeKey == $uri
                or preg_match('/' . str_replace('/', '\/', $routeKey) . '/', $uri)
            ) {
                $module = $routeValue['module'];
                $controller = $routeValue['controller'];
                if (isset($routeValue['action'])) {
                    $action = $routeValue['action'];
                }
                if (isset($routeValue['config'])) {
                    $routeConfig = $routeValue['config'];
                }
            }
        }

        if ($controller == '') {
            $controller = 'NotFound';
        }
        return array($module, $routeKey, $controller, $action, $routeConfig);
    }

    /**
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return Config
     */
    public function getConfig()
    {
        if (!$this->config) {
            $this->config = new Config($this->ymlParser->parse(file_get_contents($this->root . 'config/config.yml')));
        }
        return $this->config;
    }

    /**
     * @return mixed
     */
    public function getRouteConfig()
    {
        return $this->routeConfig;
    }

    /**
     * @return Logger
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * @return mixed
     */
    public function getRouteKey()
    {
        return $this->routeKey;
    }

    /**
     * @return string
     */
    public function getRoot()
    {
        return $this->root;
    }
}