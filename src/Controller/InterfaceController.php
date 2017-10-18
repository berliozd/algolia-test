<?php
/**
 * Created by PhpStorm.
 * User: didierberlioz
 * Date: 18/10/2017
 * Time: 22:02
 */

namespace AlgoliaTest\Controller;

interface InterfaceController
{
    /**
     * @param null $params
     */
    public function execute($params = null);
}