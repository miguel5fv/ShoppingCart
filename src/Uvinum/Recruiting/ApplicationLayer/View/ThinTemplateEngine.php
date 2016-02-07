<?php

namespace Uvinum\Recruiting\ApplicationLayer\View;

class ThinTemplateEngine implements EngineInterface
{
    private $templateVariables = array();

    public function addVariable($name, $value)
    {
        $this->templateVariables[$name] = $value;
    }

    public function render()
    {
        echo json_encode($this->templateVariables), PHP_EOL;
    }

}