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
     * @return \AlgoliaTest\App
     */
    public function getApp()
    {
        return $this->app;
    }
}