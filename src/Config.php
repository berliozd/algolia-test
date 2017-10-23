<?php
/**
 * Created by PhpStorm.
 * User: didierberlioz
 * Date: 15/10/2017
 * Time: 01:02
 */

namespace AlgoliaTest;


class Config
{

    private $appId;
    private $apiKey;
    private $indexName;

    function __construct($data)
    {
        $this->appId = $data['appId'];
        $this->apiKey = $data['apiKey'];
        $this->indexName = $data['indexName'];
    }

    /**
     * @return mixed
     */
    public function getIndexName()
    {
        return $this->indexName;
    }

    /**
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @return mixed
     */
    public function getAppId()
    {
        return $this->appId;
    }

    public function getData()
    {
        return ['appId' => $this->appId, 'apiKey' => $this->apiKey, 'indexName' => $this->indexName];
    }
}