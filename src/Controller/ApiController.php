<?php
/**
 * Created by PhpStorm.
 * User: didierberlioz
 * Date: 14/10/2017
 * Time: 22:58
 */

namespace AlgoliaTest\Controller;


abstract class ApiController extends AbstractController implements InterfaceController
{
    public function execute($params = null)
    {
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($params);
    }
}