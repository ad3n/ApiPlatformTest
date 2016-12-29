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
     * @param ItemInterface $item
     */
    public function addItem(ItemInterface $item);

    /**
     * @param ItemInterface $item
     *
     * @return ItemInterface[]
     */
    public function removeItem(ItemInterface $item): array;

    /**
     * @return ItemInterface[]
     */
    public function getItems(): array;

    /**
     * @return bool
     */
    public function isProcessed(): bool;

    /**
     * @return \DateTime
     */
    public function getProcessingDate(): \DateTime;
}
