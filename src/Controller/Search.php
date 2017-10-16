<?php

/**
 * Created by PhpStorm.
 * User: didierberlioz
 * Date: 14/10/2017
 * Time: 22:43
 */

namespace AlgoliaTest\Controller;

use AlgoliaTest\App;

class Search extends AbstractController
{

    /**
     * Search constructor.
     * @param $app App
     */
    function __construct($app)
    {
        parent::__construct($app);
    }

    public function index()
    {
        $this->getApp()->getLogger()->info('search index');
        $config = $this->getApp()->getConfig();
        $this->render($this->getApp()->getRouteConfig(), [
            'appId' => $config->getAppId(),
            'apiKey' => $config->getApiKey(),
            'indexName' => $config->getIndexName()
        ]);
    }
}