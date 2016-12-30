<?php

namespace AppBundle\Transaction;

use AppBundle\Repository\RepositoryInterface;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface TransactionRepositoryInterface extends RepositoryInterface
{
    /**
     * @param OwnerableInterface $owner
     *
     * @return TransactionInterface[]
     */
    public function findByOwner(OwnerableInterface $owner);
}
