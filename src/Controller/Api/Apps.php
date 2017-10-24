<?php
/**
 * Created by PhpStorm.
 * User: didierberlioz
 * Date: 18/10/2017
 * Time: 21:29
 */

namespace AlgoliaTest\Controller\Api;


use AlgoliaSearch\Client;
use AlgoliaTest\Constants;
use AlgoliaTest\Controller\ApiController;

class Apps extends ApiController
{

    const ALGOLIA_APPS_PARAMS = ['name', 'image', 'link', 'category', 'rank'];
    private $algoliaClient;
    private $algoliaIndex;

    /**
     * Apps constructor.
     * @param \AlgoliaTest\App $app
     */
    function __construct($app)
    {
        parent::__construct($app);
        $this->algoliaClient = new Client($app->getConfig()->getAppId(), $app->getConfig()->getApiKey());
        $this->algoliaIndex = $this->algoliaClient->initIndex($app->getConfig()->getIndexName());

    }

    /**
     * Index action : entry point for executing correct method
     */
    public function indexAction()
    {
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        if (!method_exists($this, $method)) {
            $this->notfound();
            return;
        }
        $this->$method();
    }

    /**
     * Delete method
     */
    public function delete()
    {
        $idToDelete = $this->getParam('id');
        if (is_numeric($idToDelete)) {
            $response = $this->algoliaIndex->deleteObject($idToDelete);
        } else {
            $response = $this->getPreconditionErrorResponse('missing id of object to delete');
        }
        $this->execute($response);
    }

    /**
     * Retrieve precondition error response
     * @param $message
     * @return array
     */
    private function getPreconditionErrorResponse($message)
    {
        $response = [
            'error' => 'Precondition Failed',
            'errorCode' => Constants::HTTP_PRECONDITION_FAILED_CODE,
            'message' => $message
        ];
        return $response;
    }

    /**
     * Post method
     */
    public function post()
    {
        $data = $this->getParams();
        // Keep only a selection of params
        $data = array_intersect_key($data, array_flip(self::ALGOLIA_APPS_PARAMS));

        $errorCode = null;
        if (count(self::ALGOLIA_APPS_PARAMS) != count($data)) {
            $response = $this->getPreconditionErrorResponse('incorrect number of parameters received');
            $errorCode = Constants::HTTP_KO_CODE;
        } else {
            $response = $this->algoliaIndex->addObject($data);
        }

        $this->execute($response, $errorCode);
    }
}