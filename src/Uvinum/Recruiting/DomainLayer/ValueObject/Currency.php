<?php
namespace Uvinum\Recruiting\DomainLayer\ValueObject;

/**
 * Value object is a kind of class which represents a value but have no entity. One of the most common
 * value objects are Money and Currency.
 *
 * @see http://martinfowler.com/bliki/ValueObject.html
 * @see http://stackoverflow.com/questions/5689907/currency-is-value-object-or-not
 *
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
class Currency
{
    /**
     * @var string
     */
    public $symbol;
}