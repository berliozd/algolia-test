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

            $jss_head = '';
            $jss_body = '';
            if (isset($routeConfig['js'])) {
                foreach ($routeConfig['js'] as $js) {
                    if (strpos($js, 'HEAD') === 0) {
                        $jss_head .= $this->formatJs(str_replace('HEAD:', '', $js));
                    }
                    if (strpos($js, 'BODY') === 0) {
                        $jss_body .= $this->formatJs(str_replace('BODY:', '', $js));
                    }
                }
            }
        }


        $this->setParams([
            'styles' => $styles,
            'js_head' => $jss_head,
            'content' => $viewContent,
            'js_body' => $jss_body,
        ]);
        $this->file = ROOT . 'layout/' . $file . '.phtml';
    }

    private function formatStyle($style)
    {
        return '<link href="' . $style . '" rel="stylesheet" type="text/css">' . chr(10);

    }

    private function formatJs($js)
    {
        return '<script src="' . $js . '"></script>' . chr(10);
    }
}