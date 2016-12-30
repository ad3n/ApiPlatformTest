<?php

namespace AppBundle\Transaction;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface OwnerableInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @param TransactionInterface $transaction
     */
    public function addTransaction(TransactionInterface $transaction);

    /**
     * @return TransactionInterface[]
     */
    public function getTransactions(): array;

    /**
     * @param TransactionInterface[] $transactions
     */
    public function setTransactions(array $transactions);
}
