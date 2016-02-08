<?php
namespace Uvinum\Recruiting\Domain\Entity;

/**
 * Represents the entity of a product.
 *
 * @author <miguel5fv@gmail.com>
 */
class Product
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var float
     */
    public $unitPrice;

    /**
     * @var float
     */
    public $offerPrice;

    /**
     * @var int
     */
    public $minProductAmountForOffer;

    /**
     * Product constructor. The attributes are publics, but I have decided to use the constructor like this because makes sense
     * creates a new instance with all of its attributes assigned in order to keep consistence with its entity.
     *
     * @param int $id
     * @param float $unitPrice
     * @param float $offerPrice
     * @param int $minProductAmountForOffer
     */
    public function __construct($id, $unitPrice, $offerPrice, $minProductAmountForOffer)
    {
        $this->id               = $id;
        $this->unitPrice        = $unitPrice;
        $this->offerPrice       = $offerPrice;

        $this->minProductAmountForOffer = $minProductAmountForOffer;
    }
}