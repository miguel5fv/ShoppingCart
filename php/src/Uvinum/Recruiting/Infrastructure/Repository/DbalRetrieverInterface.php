<?php
namespace Uvinum\Recruiting\Infrastructure\Repository;

/**
 * Contract for Database access to read information.
 *
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
interface DbalRetrieverInterface
{
    /**
     * Retrieve data from database given an identifier and a table.
     *
     * @param mixed $identifier
     * @param string $table
     *
     * @return mixed
     */
    public function retrieve($identifier, $table);
}