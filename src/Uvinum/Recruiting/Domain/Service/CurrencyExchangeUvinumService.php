<?php
namespace Uvinum\Recruiting\Domain\Service;

use Uvinum\Recruiting\Domain\ValueObject\Currency;

/**
 * Service to manage the change of currencies requests.
 *
 * @author <miguel5fv@gmail.com>
 */
class CurrencyExchangeUvinumService implements CurrencyExchangeInterface
{
    /**
     * @var ValueObjectRepositoryInterface
     */
    private $currencyRepository;

    /**
     * @var Currency
     */
    private $currencyBase;

    /**
     * CurrencyExchangeUvinumService constructor, injecting the needed repository value object to retrieve the currency rate
     * and the value object currency base.
     *
     * @param ValueObjectRepositoryInterface $currencyRepository
     * @param Currency $base
     */
    public function __construct(ValueObjectRepositoryInterface $currencyRepository, Currency $base)
    {
        $this->currencyRepository   = $currencyRepository;
        $this->currencyBase         = $base;
    }

    /**
     * @inherited
     */
    public function changeCurrency($price, Currency $toConvert)
    {
        $exchangeSymbols    = $this->currencyBase->symbol . $toConvert->symbol;
        $rate               = $this->currencyRepository->retrieve($exchangeSymbols);

        return false === $rate ? 0: $rate * $price;
    }
}