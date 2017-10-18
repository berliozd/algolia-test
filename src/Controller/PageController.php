<?php
/**
 * Created by PhpStorm.
 * User: didierberlioz
 * Date: 14/10/2017
 * Time: 22:58
 */

namespace AlgoliaTest\Controller;


use AlgoliaTest\Layout;
use AlgoliaTest\View;

abstract class PageController extends AbstractController implements InterfaceController
{
    /**
     * @param null $params
     */
    public function execute($params = null)
    {
        $view = new View($this->getApp()->getController(), $this->getApp()->getAction());
        if ($params) {
            $view->setParams($params);
        }
        $viewContent = $view->output();

        $layout = new Layout($this->getApp()->getRouteConfig(), $viewContent);

        echo $layout->output();
    }
}