<?php
/**
 * Created by PhpStorm.
 * User: didierberlioz
 * Date: 15/10/2017
 * Time: 00:38
 */

namespace AlgoliaTest;


class Layout extends View
{

    public function __construct($routeConfig, $viewContent)
    {
        $file = 'default';
        $styles = '';
        $jss = '';

        if ($routeConfig) {
            if (isset($routeConfig['layout'])) {
                $file = $routeConfig['layout'];
            }

            $styles = '';
            if (isset($routeConfig['styles'])) {
                foreach ($routeConfig['styles'] as $style) {
                    $styles .= $this->formatStyle($style);
                }

            }

            $jss = '';
            if (isset($routeConfig['js'])) {
                foreach ($routeConfig['js'] as $js) {
                    $jss .= $this->formatJs($js);
                }
            }
        }


        $this->setParams(['styles' => $styles, 'js' => $jss, 'content' => $viewContent]);
        $this->file = ROOT . 'layout/' . $file . '.phtml';
    }

    private function formatStyle($style)
    {
        return '<link href="' . $style . '" rel="stylesheet" type="text/css">';

    }

    private function formatJs($js)
    {
        return '<script src="' . $js . '"></script>';
    }
}