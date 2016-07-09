<?php
/**
 * This file contains all the needed to run the application. Retrieve a Command line command and execute the
 * correct controller and action.
 *
 * @author <miguel5fv@gmail.com>
 */
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/configuration/application.php';
require_once __DIR__ . '/configuration/command.php';

if ($argc < 2)
    exit('Error: Must be -> ' . __FILE__ . " <command>\n");

if (!isset($command[$argv[1]]))
    exit("Error: The command does not exist\n");

$dependencyClassName    = 'Dependency' . $command[$argv[1]];
$dependencyClassPath    =  __DIR__.'/configuration/' . $dependencyClassName . '.php';

if (!file_exists($dependencyClassPath)) {
    exit("Error: The class that specify the classes to inject via dependency injection does not exists\n");
}

require_once __DIR__ . '/configuration/' . $dependencyClassName . '.php';
$dependencies   = new $dependencyClassName();

$controller         = $dependencies->getController($applicationVariables);
$methodName         = $argv[1] . 'Action';
$classMethod        = new ReflectionMethod($controller,$methodName);
$methodParameters   = array_slice($argv, 2);
$numberParameters   = count($classMethod->getParameters());

if ( count($methodParameters) != $numberParameters)
    exit("Error: The method $methodName requires $numberParameters parameters\n");

call_user_func_array(array($controller, $methodName), $methodParameters);
