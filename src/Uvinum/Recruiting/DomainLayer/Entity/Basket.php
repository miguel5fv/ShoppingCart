<?php
namespace Uvinum\Recruiting\DomainLayer\Entity;

/**
 * Represents the basket of a shopping cart. The reason why I have decied to represent it as entity, is because in any
 * system could be more than one basket, for example for two different clients, every one will use a different basket, with
 * its different entity.
 *
 * I have decided to use public attributes on the entities because I would like to make it simple. It is recommended to use
 * getters and setters to have more control and validation process in the information assigned, but in this class no validations
 * and too much control is needed.
 *
 * @author <miguel5fv@gmail.com>
 */
class Basket
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     */
    public $totalAmount     = 0;

    /**
     * @var array
     */
    public $products        = array();

    /**
     * @var array
     */
    public $productsAmount  = array();

    /**
     * Retrieve the number of products stored in basket by its id.
     *
     * @param int $idProduct
     * @return int
     */
    public function getProductAmount($idProduct)
    {
        if (!empty($this->basket->productsAmount[$idProduct]))
            return $this->basket->productsAmount[$idProduct];

        return 0;
    }
}