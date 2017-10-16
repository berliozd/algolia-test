<?php
/**
 * Created by PhpStorm.
 * User: didierberlioz
 * Date: 14/10/2017
 * Time: 22:58
 */

namespace AlgoliaTest\Controller;


use AlgoliaTest\Layout;
use AlgoliaTest\View;

abstract class AbstractController
{

    private $app;

    /**
     * AbstractController constructor.
     * @param $app
     */
    function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * @param $routeConfig
     * @param null $variables
     */
    public function render($routeConfig = null, $variables = null)
    {
        $view = new View($this->getApp()->getController(), $this->getApp()->getAction());
        if ($variables) {
            $view->setVariables($variables);
        }
        $viewContent = $view->output();

        $layout = new Layout($routeConfig, $viewContent);

        echo $layout->output();
    }

    /**
     * @return \AlgoliaTest\App
     */
    public function getApp()
    {
        return $this->app;
    }
}