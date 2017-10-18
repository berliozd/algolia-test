<?php
/**
 * Created by PhpStorm.
 * User: didierberlioz
 * Date: 18/10/2017
 * Time: 21:29
 */

namespace AlgoliaTest\Controller\Api;


use AlgoliaSearch\Client;
use AlgoliaTest\Controller\ApiController;

class Apps extends ApiController
{

    private $algoliaClient;
    private $algoliaIndex;

    function __construct($app)
    {
        parent::__construct($app);
        $this->algoliaClient = new Client($app->getConfig()->getAppId(), $app->getConfig()->getApiKey());
        $this->algoliaIndex = $this->algoliaClient->initIndex($app->getConfig()->getIndexName());

    }

    public function indexAction()
    {
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $this->$method();
    }

    public function delete()
    {
        $this->execute($this->algoliaIndex->deleteObject(875750));
    }

    public function post()
    {
        $data = [
            "name" => "test didier",
            "image" => "http://a3.mzstatic.com/us/r1000/090/Purple/v4/20/bd/a2/20bda225-6144-cb99-46ef-d0fc15fc456a/mzl.okdjewbf.175x175-75.jpg",
            "link" => "http://itunes.apple.com/us/app/ibooks/id364709193?mt=8",
            "category" => "Books",
            "rank" => 1
        ];

        $this->execute($this->algoliaIndex->addObject($data));
    }
}