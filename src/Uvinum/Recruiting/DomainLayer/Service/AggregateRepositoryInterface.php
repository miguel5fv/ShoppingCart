<?php
namespace Uvinum\Recruiting\DomainLayer\Service;

/**
 * Implements the contract between Domain layer to the external one infrastructureLayer to be
 * able to use a repository. This interface works as a port and the repository that implements
 * it acts as adapter.
 *
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
interface AggregateRepositoryInterface
{
    /**
     * Retrieve an entity given.
     *
     * @param mixed $aggregation
     *
     * @return mixed
     */
    public function retrieve($aggregation);

    /**
     * Save in memory a given entity object.
     *
     * @param mixed $entity
     *
     * @return boolean
     */
    public function save($aggregation);
}