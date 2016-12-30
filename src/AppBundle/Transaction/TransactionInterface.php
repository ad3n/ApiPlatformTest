<?php

namespace AppBundle\Transaction;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface TransactionInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return \DateTime
     */
    public function getTransactionDate(): \DateTime;

    /**
     * @param \DateTime $dateTime
     */
    public function setTransactionDate(\DateTime $dateTime);

    /**
     * @return OwnerableInterface
     */
    public function getOwner(): OwnerableInterface;

    /**
     * @return float
     */
    public function getTotalAmount(): float;

    /**
     * @param float $totalAmount
     */
    public function setTotalAmount(float $totalAmount);

    /**
     * @return float
     */
    public function getSubTotal(): float;

    /**
     * @param float $subTotal
     */
    public function setSubTotal(float $subTotal);

    /**
     * @return float
     */
    public function getTax(): float;

    /**
     * @param float $tax
     */
    public function setTax(float $tax);

    /**
     * @return float
     */
    public function getSurchargeFee(): float;

    /**
     * @param float $surchargeFee
     */
    public function setSurchargeFee(float $surchargeFee);

    /**
     * @return float
     */
    public function getDeliveryFee(): float;

    /**
     * @param float $deliveryFee
     */
    public function setDeliveryFee(float $deliveryFee);

    /**
     * @param ItemInterface $item
     */
    public function addItem(ItemInterface $item);

    /**
     * @return ItemInterface[]
     */
    public function getItems(): array;

    /**
     * @return string
     */
    public function getTransactionStatus(): string;
}
