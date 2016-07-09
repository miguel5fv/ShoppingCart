<?php
namespace Uvinum\Recruiting\Infrastructure\Repository;

/**
 * Contract for Database access to write information.
 *
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
interface DbalStorageInterface
{
    /**
     * Save in database a given element by its identifier and into a table destination.
     *
     * @param int $identifier
     * @param mixed $data
     * @param string $table
     */
    public function save($identifier, $data, $table);
}