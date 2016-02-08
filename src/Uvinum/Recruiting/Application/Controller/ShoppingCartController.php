<?php
namespace Uvinum\Recruiting\Application\Controller;

use Uvinum\Recruiting\Domain\Service\ShoppingCartInterface;
use Uvinum\Recruiting\Domain\Entity\Product;
use Uvinum\Recruiting\Domain\ValueObject\Currency;
use Uvinum\Recruiting\Application\View\EngineInterface;

/**
 * Manage the requests from the user side to the Shopping cart. Its mission is retrieve the requests of
 * users, interact with the domain model and show to him the result.
 *
 * @author <miguel5fv@gmail.com>
 */
class ShoppingCartController
{
    /**
     * @var ShoppingCartInterface
     */
    private $shoppingCart;

    /**
     * @var EngineInterface
     */
    private $view;

    /**
     * ShoppingCartController constructor.
     *
     * @param ShoppingCartInterface $shoppingCart
     * @param EngineInterface $view
     */
    public function __construct(ShoppingCartInterface $shoppingCart, EngineInterface $view)
    {
        $this->shoppingCart = $shoppingCart;
        $this->view         = $view;
    }

    /**
     * Adds a new product to the shopping cart. Replace it if exists.
     *
     * @param int $id
     * @param float $unitPrice
     * @param float $offerPrice
     * @param int $minProductAmountForOffer
     * @param int $productAmount
     */
    public function addProductAction($id, $unitPrice, $offerPrice, $minProductAmountForOffer, $productAmount)
    {
        $product = new Product($id, $unitPrice, $offerPrice, $minProductAmountForOffer);

        $this->view->addVariable('status', $this->shoppingCart->addProduct($product, $productAmount));
        $this->view->render('addProduct');
    }

    /**
     * Remove an existing product in shopping cart
     *
     * @param int $id
     */
    public function removeProductAction($id)
    {
        $this->view->addVariable('status', $this->shoppingCart->removeProduct($id));
        $this->view->render('removeProduct');
    }

    /**
     * Show the total amount in shopping cart.
     */
    public function totalAmountAction()
    {
        $this->view->addVariable('amount', $this->shoppingCart->totalAmount());
        $this->view->render('totalAmount');
    }

    /**
     * Shows the total amount but in the indicated currency.
     *
     * @param string $symbol
     */
    public function currencyExchangeAction($symbol)
    {
        $currency           = new Currency();
        $currency->symbol   = $symbol;

        $this->view->addVariable('symbol', $symbol);
        $this->view->addVariable('exchange', $this->shoppingCart->changeCurrency($currency));
        $this->view->render('currencyExchange');
    }
}