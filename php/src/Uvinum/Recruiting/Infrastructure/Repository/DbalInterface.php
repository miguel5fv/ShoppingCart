<?php
namespace Uvinum\Recruiting\Infrastructure\Repository;

/**
 * This contract is a full Dbal contract which includes the Retriever contract and Storage contract.
 *
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
interface DbalInterface extends DbalRetrieverInterface, DbalStorageInterface
{
}