<?php
/**
 * Defines the global application data configuration.
 *
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
global $applicationVariables;

$applicationVariables   = array(
    'tableMap'              => array('currencyExchange' => 'yahoo.finance.xchange'),
    'currency'              => 'EUR',
    'basketId'              => 1, // In this case of use this always will be 1, but in reality depending on user transaction id could change.
    'maxProducts'           => 50,
    'maxDifferentProducts'  => 10,
    'localStorage'          => __DIR__ . '/../../data/'
);