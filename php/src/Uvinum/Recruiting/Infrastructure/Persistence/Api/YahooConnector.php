<?php
namespace Uvinum\Recruiting\Infrastructure\Persistence\Api;

/**
 * Specific connector api for Yahoo apis.
 *
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
class YahooConnector implements ConnectorInterface
{
    /**
     * @inherited
     */
    public function getContent($query, $format)
    {
        $url    = $this->buildUrl($query, $format);
        return $this->getContentFromRemote($url);
    }

    /**
     * Builds the url needed to connect with the Api.
     *
     * @param string $query
     * @param string $format
     * @return string
     */
    private function buildUrl($query, $format)
    {
        return 'http://query.yahooapis.com/v1/public/'
                . 'yql?q='  . urlencode($query)
                . '&format='. urlencode($format)
                . '&env='   . urlencode('store://datatables.org/alltableswithkeys');
    }

    /**
     * Retrieve content from remote source.
     *
     * @param string $url
     * @return string
     */
    private function getContentFromRemote($url)
    {
        return file_get_contents($url);
    }
}