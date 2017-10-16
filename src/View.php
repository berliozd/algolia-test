<?php
/**
 * Created by PhpStorm.
 * User: didierberlioz
 * Date: 14/10/2017
 * Time: 23:42
 */

namespace AlgoliaTest;


class View
{

    protected $file;
    private $variables;

    public function __construct($controllerName, $actionName, $layout = 'default')
    {
        $this->file = ROOT . 'view/' . strtolower(str_replace(Constants::CONTROLLER_NAMESPACE_ROOT, '',
                $controllerName)) . '/' . $actionName . '.phtml';
    }

    /**
     * Set an array of variables.
     * Ex : with array("addMode" => true), $addMode will be available in Template
     * @param array $variables
     */
    public function setVariables($variables)
    {
        $this->variables = $variables;
    }

    public function output()
    {

        if (!file_exists($this->file)) {
            return "Error loading template file ($this->file).<br />";
        }
        $output = $this->_getOuput();

        return $output;
    }


    private function _getOuput()
    {
        ob_start();

        // Extract variables to make them accessible in the template
        if (is_array($this->variables)) {
            extract($this->variables);
        }

        include $this->file;

        $output = ob_get_contents();

        ob_end_clean();

        return $output;
    }

}