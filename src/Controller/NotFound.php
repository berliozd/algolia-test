<?php

/**
 * Created by PhpStorm.
 * User: didierberlioz
 * Date: 14/10/2017
 * Time: 22:43
 */

namespace AlgoliaTest\Controller;

class NotFound extends AbstractController
{

    function __construct($app)
    {
       parent::__construct($app);
    }

    public function index()
    {
        $this->getApp()->getLogger()->info('notfound index');
        $this->render();
    }
}