<?php
namespace Uvinum\Recruiting\InfrastructureLayer\Persistence\Api;

/**
 * Contract for process result sets of Apis results.
 *
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
interface ResultSetInterface
{
    /**
     * Set the data to be processed.
     *
     * @param array $data
     * @return mixed
     */
    public function setData(array $data);

    /**
     * Fetch the current result retrieved.
     *
     * @return mixed
     */
    public function fetchResult();
}