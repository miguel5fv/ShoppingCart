<?php
namespace Uvinum\Recruiting\InfrastructureLayer\Persistence\Api;

/**
 * Defines the contract of any query builder for Api resources contents.
 *
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
interface QueryBuilderInterface
{
    /**
     * Sets the fields that we want to retrieve from the Api source.
     *
     * @param string $fields
     */
    public function setSelectedFields($fields);

    /**
     * Name of the table where retrieve the information.
     *
     * @param string $name
     */
    public function setTable($name);

    /**
     * Sets the conditions for the query.
     *
     * @param array $values
     */
    public function setCondition(array $values);

    /**
     * Retrieve the query built.
     *
     * @return mixed
     */
    public function build();
}