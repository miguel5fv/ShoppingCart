<?php
namespace Uvinum\Recruiting\InfrastructureLayer\Persistence\Api;

/**
 * Defines the contract of any Api connectors.
 *
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
interface ConnectorInterface
{
    /**
     * Retrieve the content for a given query and format out of an API.
     *
     * @param mixed $query
     * @param string $format
     *
     * @return mixed
     */
    public function getContent($query, $format);
}