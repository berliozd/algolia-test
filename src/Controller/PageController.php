<?php
/**
 * Created by PhpStorm.
 * User: didierberlioz
 * Date: 14/10/2017
 * Time: 22:58
 */

namespace AlgoliaTest\Controller;


use AlgoliaTest\Constants;
use AlgoliaTest\Layout;
use AlgoliaTest\View;

abstract class PageController extends AbstractController implements InterfaceController
{
    /**
     * @param null $params
     * @param int $code
     */
    public function execute($params = null, $code = Constants::HTTP_OK_CODE)
    {

        $view = new View($this->getApp());
        if ($params) {
            $view->setParams($params);
        }
        $viewContent = $view->output();

        $layout = new Layout($this->getApp(), $viewContent);

        header('Content-Type: text/html; charset=utf-8', true, $code);
        echo $layout->output();
    }
}