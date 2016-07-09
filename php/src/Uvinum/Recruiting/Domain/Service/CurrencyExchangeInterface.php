<?php
namespace Uvinum\Recruiting\Domain\Service;

use Uvinum\Recruiting\Domain\ValueObject\Currency;

/**
 * This interface is needed because define the contract of the currency exchanges. Could be multiple for example:
 *  - CurrencyExchangeWithRealWorldComissions
 *  - CurrencyExchangeWithSantanderBankPrices
 *  - etc
 *
 * @author <miguel5fv@gmail.com>
 */
interface CurrencyExchangeInterface
{
    /**
     * Calculate the price in the given currency.
     *
     * @param float $price
     * @param Currency $toConvert
     *
     * @return float
     */
    public function changeCurrency($price, Currency $toConvert);
}