<?php
namespace Uvinum\Recruiting\Infrastructure\Repository;

use Uvinum\Recruiting\Domain\Entity\Product;
use Uvinum\Recruiting\Domain\Service\AggregateRepositoryInterface;
use Uvinum\Recruiting\Domain\Aggregate\Basket;

/**
 * This class implements a basket of repository to operate with a database and map the result set
 * to a set of objects. The Basket entity is needed because we need to maintain the products added and
 * amount of data.
 *
 * @see https://dzone.com/articles/martin-fowler-orm-hate
 *
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
class BasketRepository implements AggregateRepositoryInterface
{
    /**
     * @var DbalInterface
     */
    private $dbal;

    /**
     * @var string
     */
    private $tableName    = 'basket';

    /**
     * BasketRepository constructor. Injects the database administrator object.
     *
     * @param DbalInterface $dbal
     */
    public function __construct(DbalInterface $dbal)
    {
        $this->dbal = $dbal;
    }

    /**
     * @inherited
     */
    public function retrieve($basket)
    {
        try {
            $dataRetrieved = $this->dbal->retrieve($basket->getId(), $this->tableName);

            if (!empty($dataRetrieved))
                $basket = $this->fillBasket($basket, $dataRetrieved);
        } catch (\UnexpectedValueException $exception) {
            return $basket;
        }

        return $basket;
    }

    /**
     * Fills a basket with the data retrieved.
     *
     * @param Basket $basket
     * @param array $dataRetrieved
     * @return Basket
     */
    private function fillBasket(Basket $basket, array $dataRetrieved)
    {
        foreach ($dataRetrieved as $data) {
            $product    = new Product(
                $data['id'],
                $data['unitPrice'],
                $data['offerPrice'],
                $data['minProductAmountForOffer']
            );
            $basket->addProduct($product, $data['productAmount']);
        }

        return $basket;
    }

    /**
     * @inherited
     */
    public function save($basket)
    {
        $dataToSave = $this->retrieveData($basket);
        $this->dbal->save($basket->getId(), $dataToSave, $this->tableName);
    }

    /**
     * Converts the data extracted from array to a set of products.
     *
     * @param Basket $basket
     * @return array
     */
    private function retrieveData(Basket $basket)
    {
        $products       = $basket->getProducts();
        $productsAmount = $basket->getProductsAmount();
        $dataToSave     = array();

        foreach ($products as $idProduct => $product) {
            $productArray                   = get_object_vars($product);
            $productArray['productAmount']  = $productsAmount[$idProduct];

            $dataToSave[]   = $productArray;
        }

        return $dataToSave;
    }
}