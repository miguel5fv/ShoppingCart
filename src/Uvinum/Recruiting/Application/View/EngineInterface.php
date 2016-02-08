<?php
namespace Uvinum\Recruiting\Application\View;

/**
 * Contract for any view engine representation. Examples could be:
 *  + Json output
 *  + XML output
 *  + Twig template engine
 *  ....
 *
 * @author <miguel5fv@gmail.com>
 */
interface EngineInterface
{
    /**
     * Adds a variable that could be used in the output, but it is not mandatory to use the variable.
     *
     * @param string $name
     * @param mixed $value
     */
    public function addVariable($name, $value);

    /**
     * Render the output data, could be the render of a template, xml or a json file.
     */
    public function render();
}