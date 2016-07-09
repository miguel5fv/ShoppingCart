<?php
namespace Uvinum\Recruiting\Infrastructure\Persistence;

use Uvinum\Recruiting\Infrastructure\Persistence\Api\ConnectorInterface;
use Uvinum\Recruiting\Infrastructure\Persistence\Api\QueryBuilderInterface;
use Uvinum\Recruiting\Infrastructure\Repository\DbalRetrieverInterface;

/**
 * Engine to retrieve data from Apis in Json format.
 *
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
class JsonApi implements DbalRetrieverInterface
{
    /**
     * @var ConnectorInterface
     */
    private $connectorApi;

    /**
     * @var QueryBuilderInterface
     */
    private $queryBuilder;

    /**
     * JsonApi constructor. Injected the connector and query builder to retrieve and process the Api data.
     *
     * @param ConnectorInterface $connectorApi
     * @param QueryBuilderInterface $queryBuilder
     */
    public function __construct(ConnectorInterface $connectorApi, QueryBuilderInterface $queryBuilder)
    {
        $this->connectorApi = $connectorApi;
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * @inherited
     */
    public function retrieve($condition, $table)
    {
        $this->queryBuilder->setTable($table);
        $this->queryBuilder->setCondition($condition);

        $json   = $this->connectorApi->getContent($this->queryBuilder->build(), 'json');
        $result = json_decode($json, true);

        return is_null($result) ? array() : $result;
    }
}