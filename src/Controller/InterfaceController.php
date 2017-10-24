<?php
/**
 * Created by PhpStorm.
 * User: didierberlioz
 * Date: 18/10/2017
 * Time: 22:02
 */

namespace AlgoliaTest\Controller;

use AlgoliaTest\Constants;

interface InterfaceController
{
    /**
     * @param null $params
     * @param int $code
     * @return
     */
    public function execute($params = null, $code = Constants::HTTP_OK_CODE);
}