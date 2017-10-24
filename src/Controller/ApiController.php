<?php
/**
 * Created by PhpStorm.
 * User: didierberlioz
 * Date: 14/10/2017
 * Time: 22:58
 */

namespace AlgoliaTest\Controller;


use AlgoliaTest\Constants;

abstract class ApiController extends AbstractController implements InterfaceController
{

    public function notfound()
    {
        $this->execute(['error' => 'notfound', 'errorCode' => Constants::HTTP_NOT_FOUND_CODE],
            Constants::HTTP_NOT_FOUND_CODE);
    }

    public function execute($params = null, $code = Constants::HTTP_OK_CODE)
    {
        header('Content-type: application/json; charset=utf-8', true, $code);
        echo json_encode($params);
    }
}