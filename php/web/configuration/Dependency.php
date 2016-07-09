<?php

/**
 * This interface declare the contract for the class configuration dependencies of a controller. This is needed to insert
 * the dependencies to the controller when it is created. This task could be more sofisticated using:
 *
 *  + Configuration file like YAML or JSON
 *  + Using a container dependency injection like Pimple
 *  + Using a framework like Symfony or Silex (even Silex does not have implemented a dependency injection file config like Symfony, you have
 *      to implemented, and register every class to the container manually)
 *
 * So, why so simple? Because the important here, as I understood in the PDF exercise is the design of the business model an application, not the
 * framework used, and this is more from the framework side rather than design application itself.
 *
 * @author <miguel5fv@gmail.com>
 */
interface Dependency
{
    /**
     * Retrieve the instance of the controller represented in this configuration class. This controller have injected all of the
     * classes dependency instances.
     *
     * @param array $applicationVariables
     * @return mixed
     */
    public function getController($applicationVariables);
}