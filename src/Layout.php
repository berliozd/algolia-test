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

    /**
     * Layout constructor.
     * @param App $app
     * @param string $viewContent
     */
    public function __construct($app, $viewContent)
    {
        $file = 'default';
        $styles = '';
        $jss_head = '';
        $jss_body = '';

        $routeConfig = $app->getRouteConfig();

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
        $this->file = $app->getRoot() . 'layout/' . $file . '.phtml';
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