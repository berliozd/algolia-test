<?php

/**
 * Created by PhpStorm.
 * User: didierberlioz
 * Date: 14/10/2017
 * Time: 22:43
 */

namespace AlgoliaTest\Controller\Page;

use AlgoliaTest\Controller\PageController;


class NotFound extends PageController
{

    function __construct($app)
    {
        parent::__construct($app);
    }

    public function indexAction()
    {
        $this->getApp()->getLogger()->info('notfound index');
        $this->execute();
    }
}