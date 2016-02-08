<?php
namespace Uvinum\Recruiting\Infrastructure\Persistence;

use Uvinum\Recruiting\Infrastructure\Repository\DbalInterface;

/**
 * This class implement the JSON data file in local database..
 *
 * It is the most external part of the implementation. Following the Hexagonal
 * architecture, this class are completely independent of the business logic.
 *
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
class JsonFile implements DbalInterface
{
    /**
     * @var string
     */
    private $dataSource;

    /**
     * Prepares the default data source path.
     */
    public function __construct($dataSource)
    {
        $this->dataSource   = $dataSource;

        $this->checkDataSourceExists();

    }

    /**
     * Checks if exists the datasource given
     *
     * @throws \InvalidArgumentException
     */
    private function checkDataSourceExists()
    {
        if (!is_dir($this->dataSource) && !$this->existsDocument($this->dataSource))
            throw new \InvalidArgumentException("Any Json could be retrieved because {$this->dataSource} not exists");
    }

    /**
     * Retrieve the information from local decoding json format.
     *
     * @param mixed $identifier
     * @param string $table
     * @return array
     *
     * @throws UnexpectedValueException
     */
    public function retrieve($identifier, $table)
    {
        $source =  $this->getSourceFilename($table, $identifier);

        if (!$this->existsDocument($source)) {
            throw new \UnexpectedValueException("The $source doesnt't exist.");
        }

        $document   = $this->retrieveDocument($source);

        return !empty($document)? $document: array();
    }

    /**
     * Save the information in local
     *
     * @param int $identifier
     * @param mixed $data
     * @param string $table
     */
    public function save($identifier, $data, $table)
    {
        $source = $this->getSourceFilename($table, $identifier);

        file_put_contents($source, json_encode($data));
    }

    /**
     * Builds the full file name for data source given the identifier document.
     *
     * @param string $table
     * @param int $identifier
     *
     * @return string
     */
    private function getSourceFilename($table, $identifier)
    {
        return $this->dataSource . "$table-$identifier.json";
    }

    /**
     * Checks if the document exists.
     *
     * @param string $sourceFile
     *
     * @return bool
     */
    private function existsDocument($sourceFile)
    {
        return file_exists($sourceFile);
    }

    /**
     * Retrieve the content of the document in array format.
     *
     * @param string $sourceFile
     *
     * @return array
     */
    private function retrieveDocument($sourceFile)
    {
        return json_decode(file_get_contents($sourceFile), true);
    }
}