<?php
namespace Uvinum\Recruiting\Domain\Service;

use Uvinum\Recruiting\Domain\Aggregate\Basket;
use Uvinum\Recruiting\Domain\Entity\Product;
use Uvinum\Recruiting\Domain\ValueObject\Currency;

/**
 * Service to manage the interaction with shopping cart but addapted for the uvinum case of study.
 *
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
class ShoppingCartCaseOfStudyService implements ShoppingCartInterface
{
    /**
     * @var Basket
     */
    private $basket;

    /**
     * @var AggregateRepositoryInterface
     */
    private $basketRepository;

    /**
     * @var CurrencyExchangeInterface
     */
    private $currencyExchange;


    /**
     * ShoppingCartCaseOfStudyService constructor. Needed to inject all the needed dependencies to make it consistent just
     * when the instance is created.
     *
     * @param AggregateRepositoryInterface $basketRepository
     * @param CurrencyExchangeInterface $currencyExchange
     * @param Basket $basket
     */
    public function __construct(
        AggregateRepositoryInterface $basketRepository,
        CurrencyExchangeInterface $currencyExchange,
        Basket $basket
    )
    {
        $this->basketRepository     = $basketRepository;
        $this->currencyExchange     = $currencyExchange;
        $this->basket               = $this->basketRepository->retrieve($basket);
    }

    /**
     * @inherited
     */
    public function addProduct(Product $product, $productAmount)
    {
        $isAdded    = $this->basket->addProduct($product, $productAmount);
        if (Basket::ADD_PRODUCT_OK  === $isAdded)
            $this->basketRepository->save($this->basket);

        return $isAdded;
    }


    /**
     * @inherited
     */
    public function removeProduct($idProduct)
    {
        $isRemoved  = $this->basket->removeProduct($idProduct);
        if (true === $isRemoved)
            $this->basketRepository->save($this->basket);

        return $isRemoved;
    }

    /**
     * @inherited
     */
    public function totalAmount()
    {
        return $this->basket->getTotalAmount();
    }

    /**
     * @inherited
     */
    public function changeCurrency(Currency $toChange)
    {
        return $this->currencyExchange->changeCurrency($this->basket->getTotalAmount(), $toChange);
    }
}