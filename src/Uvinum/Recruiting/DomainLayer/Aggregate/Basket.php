<?php
namespace Uvinum\Recruiting\DomainLayer\Aggregate;

use Uvinum\Recruiting\DomainLayer\Entity\Product;

/**
 * Represents the basket of a shopping cart. The reason why I have decided to represent it as aggregate, is because contains a
 * collection of Products that can be treated as a single unit.
 *
 * @see http://martinfowler.com/bliki/DDD_Aggregate.html
 *
 * @author <miguel5fv@gmail.com>
 */
class Basket
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $maxProducts;

    /**
     * @var int
     */
    private $maxDifferentProducts;

    /**
     * @var int
     */
    private $totalAmount     = 0;

    /**
     * @var array
     */
    private $products        = array();

    /**
     * @var array
     */
    private $productsAmount  = array();

    /**
     * @const int
     */
    const ADD_PRODUCT_OK            = 0;

    /**
     * @const int
     */
    const ADD_PRODUCT_MAX_UNITS     = 1;

    /**
     * @const int
     */
    const ADD_PRODUCT_FULL_BASKET   = 2;

    /**
     * Basket constructor. Inject the configuration.
     *
     * @param int $maxProduct
     * @param int $maxDifferentProduct
     */
    public function __construct($id, $maxProduct, $maxDifferentProduct)
    {
        $this->id                   = $id;
        $this->maxProducts          = $maxProduct;
        $this->maxDifferentProducts = $maxDifferentProduct;
    }

    /**
     * Adds a new product if exists.
     *
     * @param Product $product
     * @param int $productAmount
     * @return int
     */
    public function addProduct(Product $product, $productAmount)
    {
        if ($this->maxProducts >= $productAmount && $this->productFitsInBasket($product->id))
        {
            $this->removeProduct($product->id);

            $this->products[$product->id]       = $product;
            $this->productsAmount[$product->id] = $productAmount;
            $this->totalAmount  += $this->getTotalAmountProducts($product, $productAmount);

            return self::ADD_PRODUCT_OK;
        }

        return $this->maxProducts >= $productAmount? self::ADD_PRODUCT_FULL_BASKET: self::ADD_PRODUCT_MAX_UNITS;
    }

    /**
     * Checks if a new products could be fitted into a basket.
     *
     * @param int $idProduct
     * @return bool
     */
    private function productFitsInBasket($idProduct)
    {
        return
            (isset($this->products[$idProduct])
                || $this->maxDifferentProducts > count($this->products));
    }

    /**
     * Remove a product if exists.
     *
     * @param int $idProduct
     * @return bool
     */
    public function removeProduct($idProduct)
    {
        if (isset($this->products[$idProduct])) {
            $product        = $this->products[$idProduct];
            $productAmount  = $this->getProductAmount($idProduct);

            unset($this->products[$idProduct]);
            unset($this->productsAmount[$idProduct]);

            $this->totalAmount -= $this->getTotalAmountProducts($product, $productAmount);

            return true;
        }

        return false;
    }

    /**
     * Retrieve the total price for the amount of products and applying the offer prices when is required.
     *
     * @return float
     */
    private function getTotalAmountProducts(Product $product, $productAmount)
    {
        if ($product->minProductAmountForOffer <= $productAmount)
            return $productAmount * $product->offerPrice;

        return $productAmount * $product->unitPrice;
    }

    /**
     * Retrieve the number of products stored in basket by its id.
     *
     * @param int $idProduct
     * @return int
     */
    public function getProductAmount($idProduct)
    {
        if (!empty($this->productsAmount[$idProduct]))
            return $this->productsAmount[$idProduct];

        return 0;
    }

    /**
     * Returns the total amount.
     *
     * @return float
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * Retrieve all the products storaged
     *
     * @return array
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Returns the id of the basket.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Retrieve all the amount products registered.
     *
     * @return array
     */
    public function getProductsAmount()
    {
        return $this->productsAmount;
    }
}