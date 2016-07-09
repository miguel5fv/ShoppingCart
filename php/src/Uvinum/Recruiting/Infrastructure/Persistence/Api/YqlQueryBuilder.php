<?php
namespace Uvinum\Recruiting\Infrastructure\Persistence\Api;

/**
 * Query Builder for the language YQL for the Apis Yahoo databases.
 *
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
class YqlQueryBuilder implements QueryBuilderInterface
{
    /**
     * @var array
     */
    private $tableMap   = array();

    /**
     * @var string
     */
    private $table;

    /**
     * @var string
     */
    private $condition;

    /**
     * @var array
     */
    private $fields;

    /**
     * YqlQueryBuilder constructor. Inject the mapping between name table and real YQL table name.
     *
     * @param array $tableMap
     */
    public function __construct(array $tableMap)
    {
        $this->tableMap = $tableMap;
    }

    /**
     * @inherited
     */
    public function setSelectedFields($fields)
    {
        $this->fields   = $fields;
    }

    /**
     * @inherited
     */
    public function setTable($name)
    {
        if (isset($this->tableMap[$name]))
            $this->table    = $this->tableMap[$name];
        else
            $this->table    = $name;
    }

    /**
     * @inherited
     */
    public function setCondition(array $condition)
    {
        $fieldName          = key($condition);
        $this->condition    = $fieldName . ' in ( "' . $condition[$fieldName] . '" )';
    }

    /**
     * @inherited
     */
    public function build()
    {
        return "SELECT {$this->getFields()} FROM {$this->table} WHERE {$this->condition}";
    }

    /**
     * Converts fields to string selected fields
     *
     * @return string
     */
    private function getFields()
    {
        if (empty($this->fields))
            return '*';
        else
            return implode(',', $this->fields);
    }
}