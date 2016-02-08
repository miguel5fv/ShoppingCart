<?php
namespace Uvinum\Recruiting\Infrastructure\Persistence\Api;

/**
 * Yahoo result set class to process the api results.
 *
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
class YahooResultSet implements ResultSetInterface
{
    /**
     * @var array
     */
    private $data = array();

    /**
     * @inherited
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * @inherited
     */
    public function fetchResult()
    {
        if (isset($this->data['query']['results']))
            return current($this->data['query']['results']);

        return false;
    }
}