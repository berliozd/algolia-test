<?php
/**
 * Created by PhpStorm.
 * User: didierberlioz
 * Date: 14/10/2017
 * Time: 22:58
 */

namespace AlgoliaTest\Controller;


use AlgoliaTest\App;

abstract class AbstractController
{

    private $app;

    /**
     * AbstractController constructor.
     * @param App $app
     */
    function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * @param $paramName
     * @return mixed
     */
    protected function getParam($paramName)
    {
        if ($_SERVER['QUERY_STRING'] && $_GET[$paramName]) {
            $idToDelete = $_GET['id'];
        } else {
            $idToDelete = str_replace('/' . $this->getApp()->getRouteKey() . '/', '', $_SERVER['REQUEST_URI']);
        }
        return $idToDelete;
    }

    /**
     * @return \AlgoliaTest\App
     */
    public function getApp()
    {
        return $this->app;
    }

    protected function getParams()
    {
        return $_POST;
    }


}