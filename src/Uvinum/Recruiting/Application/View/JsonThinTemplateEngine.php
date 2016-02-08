<?php
namespace Uvinum\Recruiting\Application\View;

/**
 * Very simple view engine to be used in this case of study. I want a simplest one to avoid to much code, and keep it
 * simple because the scope of the exercise is the behaviour of the shopping cart and the design system.
 *
 * @author <miguel5fv@gmail.com>
 */
class JsonThinTemplateEngine implements EngineInterface
{
    /**
     * @var array
     */
    private $templateVariables = array();

    /**
     * Sets the variable to be outputed.
     *
     * @param string $name
     * @param mixed $value
     */
    public function addVariable($name, $value)
    {
        $this->templateVariables[$name] = $value;
    }

    /**
     * Outputs the variables setted in json format.
     */
    public function render()
    {
        echo json_encode($this->templateVariables), PHP_EOL;
    }

}