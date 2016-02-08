<?php
require_once 'Dependency.php';

use Uvinum\Recruiting\Application\View\JsonThinTemplateEngine;
use Uvinum\Recruiting\Domain\Service\ShoppingCartCaseOfStudyService;
use Uvinum\Recruiting\Application\Controller\ShoppingCartController;
use Uvinum\Recruiting\Infrastructure\Repository\BasketRepository;
use Uvinum\Recruiting\Domain\Service\CurrencyExchangeUvinumService;
use Uvinum\Recruiting\Infrastructure\Persistence\Api\YqlQueryBuilder;

use Uvinum\Recruiting\Infrastructure\Repository\CurrencyRepository;
use Uvinum\Recruiting\Infrastructure\Persistence\JsonApi;
use Uvinum\Recruiting\Infrastructure\Persistence\JsonFile;
use Uvinum\Recruiting\Domain\Aggregate\Basket;

/**
 * Class which contains all of the dependencies of the ShoppingCart controller.
 *
 * @author <miguel5fv@gmail.com>
 */
class DependencyShoppingCart implements Dependency
{
    /**
     * @inherited
     */
    public function getController($applicationVariables)
    {
        $shoppingCart   = new ShoppingCartCaseOfStudyService(
            $this->configureBasketRespository($applicationVariables),
            $this->configureCurrencyService($applicationVariables),
            new Basket(
                $applicationVariables['basketId'],
                $applicationVariables['maxProducts'],
                $applicationVariables['maxDifferentProducts']
            )
        );

        return new ShoppingCartController($shoppingCart, new JsonThinTemplateEngine());
    }

    /**
     * Retrieve an instance of a BasketRespository configured.
     *
     * @return BasketRepository
     */
    private function configureBasketRespository($applicationVariables)
    {
        $dbal   = new JsonFile($applicationVariables['localStorage']);

        return new BasketRepository($dbal);
    }

    /**
     * Retrieve an instance of a CurrencyService configured with its dependencies.
     *
     * @param array $applicationVariables
     * @return CurrencyExchangeUvinumService
     */
    private function configureCurrencyService(array $applicationVariables)
    {
        $connector      = new Uvinum\Recruiting\Infrastructure\Persistence\Api\YahooConnector();
        $resultSet      = new Uvinum\Recruiting\Infrastructure\Persistence\Api\YahooResultSet();
        $currency       = new Uvinum\Recruiting\Domain\ValueObject\Currency();

        $currency->symbol   = $applicationVariables['currency'];

        $queryBuilder   = new YqlQueryBuilder($applicationVariables['tableMap']);
        $dbal           = new JsonApi($connector, $queryBuilder);
        $repository     = new CurrencyRepository($dbal, $resultSet);

        return new CurrencyExchangeUvinumService($repository, $currency);
    }
}


