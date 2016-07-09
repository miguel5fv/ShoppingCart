<?php
namespace Uvinum\Recruiting\Domain\Service;

/**
 * Implements the contract between Domain layer to the external one Infrastructure to be
 * able to use a repository. This interface works as a port and the repository that implements
 * it acts as adapter.
 *
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
interface ValueObjectRepositoryInterface
{
    /**
     * Retrieve a value for a value object.
     *
     * @param mixed $symbolIdentifier
     * @return mixed
     */
    public function retrieve($symbolIdentifier);
}