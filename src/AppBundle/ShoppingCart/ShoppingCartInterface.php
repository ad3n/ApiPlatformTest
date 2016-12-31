<?php

namespace AppBundle\ShoppingCart;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface ShoppingCartInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getUniqueId(): string;

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
     * @param ShoppingCartItemInterface $item
     */
    public function addItem(ShoppingCartItemInterface $item);

    /**
     * @param ShoppingCartItemInterface[] $items
     */
    public function setItems(array $items);

    /**
     * @return ShoppingCartItemInterface[]
     */
    public function getItems(): array;

    /**
     * @return bool
     */
    public function isProcessed(): bool;

    /**
     * @return \DateTime|null
     */
    public function getProcessingDate();
}
