<?php
/**
 * Created by PhpStorm.
 * User: didierberlioz
 * Date: 15/10/2017
 * Time: 01:02
 */

namespace AlgoliaTest;


use ReflectionClass;

class Config
{

    private $appId;
    private $apiKey;
    private $indexName;
    private $indexFirstReplica;
    private $indexSecondReplica;

    function __construct($data)
    {
        foreach ($data as $fieldKey => $fieldValue) {
            $this->$fieldKey = $fieldValue;
        }
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

    /**
     * @return mixed
     */
    public function getData()
    {
        $data = [];
        $reflect = new ReflectionClass($this);
        $props = $reflect->getProperties(\ReflectionProperty::IS_PRIVATE);
        foreach ($props as $prop) {
            $propName = $prop->getName();
            $data[$prop->getName()] = $this->$propName;
        }

        /** @var array $data */
        return $data;
    }
}