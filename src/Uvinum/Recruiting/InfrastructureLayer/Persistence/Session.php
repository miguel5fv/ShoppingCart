<?php

namespace Uvinum\Recruiting\InfrastructureLayer\Persistence;

use Uvinum\Recruiting\InfrastructureLayer\Repository\DbalInterface;

/**
 * To managing data storing in session. This in Command line does not works, but I have decided to change it to demostrate
 * in the next commit the easy replacement of this system without affecting in any other part of the application.
 *
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
class Session implements DbalInterface
{
    /**
     * @inherited
     */
    public function retrieve($identifier, $namespace)
    {
        if (isset($_SESSION[$namespace][$identifier]))
            return $_SESSION[$namespace][$identifier];

        return false;
    }

    /**
     * @inherited
     */
    public function save($identifier, $element, $namespace)
    {
        $_SESSION[$namespace][$identifier] = $element;
    }
}