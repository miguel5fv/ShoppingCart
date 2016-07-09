<?php
/**
 * Defines the commands accepted by the application and what is the controller where belongs to.
 *
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
global $command;

$command    = array(
    'addProduct'        => 'ShoppingCart',
    'removeProduct'     => 'ShoppingCart',
    'totalAmount'       => 'ShoppingCart',
    'currencyExchange'  => 'ShoppingCart'
);