<?php

namespace AppBundle\Transaction;

use AppBundle\ShoppingCart\OwnerableInterface as ShoppingCartOwnerInterface;
use AppBundle\ShoppingCart\ShoppingCartItemInterface;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface TransactionInterface extends ShoppingCartOwnerInterface
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
     * @return float
     */
    public function getDiscount(): float;

    /**
     * @param float $discount
     */
    public function setDiscount(float $discount);

    /**
     * @param ShoppingCartItemInterface $item
     */
    public function addItem(ShoppingCartItemInterface $item);

    /**
     * @return ShoppingCartItemInterface[]
     */
    public function getItems(): array;

    /**
     * @param array $items
     */
    public function setItems(array $items);

    /**
     * @return string
     */
    public function getTransactionStatus(): string;

    /**
     * @param string $status
     */
    public function setTransactionStatus(string $status);

    /**
     * @return string
     */
    public function getTransactionNote(): string;

    /**
     * @return \DateTime|null
     */
    public function getCompletedAt();
}
