<?php

/**
 * Created by PhpStorm.
 * User: didierberlioz
 * Date: 14/10/2017
 * Time: 22:43
 */

namespace AlgoliaTest\Controller\Page;

use AlgoliaTest\App;
use AlgoliaTest\Controller\PageController;

class Search extends PageController
{

    /**
     * Search constructor.
     * @param $app App
     */
    function __construct($app)
    {
        parent::__construct($app);
    }

    public function indexAction()
    {
        $this->getApp()->getLogger()->info('search index');
        $config = $this->getApp()->getConfig();
        $this->execute([
            'appConfig' => json_encode($config->getData())
        ]);
    }
}