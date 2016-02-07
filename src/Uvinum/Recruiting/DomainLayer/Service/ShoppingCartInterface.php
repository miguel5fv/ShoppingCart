<?php
namespace Uvinum\Recruiting\DomainLayer\Service;

use Uvinum\Recruiting\DomainLayer\Entity\Product;
use Uvinum\Recruiting\DomainLayer\ValueObject\Currency;

/**
 * Defines the contract for any shopping cart services. The implementation does not matters.
 *
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
interface ShoppingCartInterface
{
    /**
     * Add a new product in the basket of the shopping cart.
     *
     * @param Product $product
     * @param int $productAmount
     * @return int
     */
    public function addProduct(Product $product, $productAmount);

    /**
     * Remove a product from the basket given an id product.
     *
     * @param $idProduct
     *
     * @return bool
     */
    public function removeProduct($idProduct);

    /**
     * Retrieve the total amount.
     *
     * @return int
     */
    public function totalAmount();

    /**
     * Retrieve the total amount in other currency.
     *
     * @param Currency $toChange
     * @return float
     */
    public function changeCurrency(Currency $toChange);
}