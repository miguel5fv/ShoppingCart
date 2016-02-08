<?php
namespace Uvinum\Recruiting\Infrastructure\Repository;

use Uvinum\Recruiting\Domain\Service\ValueObjectRepositoryInterface;
use Uvinum\Recruiting\Infrastructure\Persistence\Api\ResultSetInterface;

/**
 * This repository is needed because the currency rate value is provided by an external source. This rates changes every second
 * because is a trading real time value.
 *
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
class CurrencyRepository implements ValueObjectRepositoryInterface
{
    /**
     * @var DbalRetrieverInterface
     */
    private $dbal;

    /**
     * @var ResultSetInterface
     */
    private $resultSet;

    /**
     * @var string
     */
    private $table    = 'currencyExchange';

    /**
     * CurrencyRepository constructor, to inject the result set object to process the result from the database.
     *
     * @param DbalRetrieverInterface $dbal
     * @param ResultSetInterface $resultSet
     */
    public function __construct(DbalRetrieverInterface $dbal, ResultSetInterface $resultSet)
    {
        $this->dbal         = $dbal;
        $this->resultSet    = $resultSet;
    }

    /**
     * @inherited
     */
    public function retrieve($symbol)
    {
        $ratePrice = $this->dbal->retrieve(array('pair' => $symbol), $this->table);

        return $this->fetchRate($ratePrice);
    }

    /**
     * Retrieve the rate value retrieved from the external source.
     *
     * @param mixed $ratePrice
     * @return float|false in case of no result fetched.
     */
    private function fetchRate($ratePrice)
    {
        $this->resultSet->setData($ratePrice);
        $results    = $this->resultSet->fetchResult();

        if (isset($results['Rate']))
            return $results['Rate'];

        return false;
    }
}