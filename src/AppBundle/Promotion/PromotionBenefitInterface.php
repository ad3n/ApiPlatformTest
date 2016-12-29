<?php

namespace AppBundle\Promotion;

use AppBundle\Product\ProductInterface;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface PromotionBenefitInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @return ItemInterface[]
     */
    public function getItems(): array;

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
     * @return float
     */
    public function getDiscountValue(): float;

    /**
     * @return float
     */
    public function getDiscountPercentage(): float;

    /**
     * @return float
     */
    public function getCashback(): float;

    /**
     * @return ProductInterface
     */
    public function getProduct(): ProductInterface;

    /**
     * @return string
     */
    public function getVoucher(): string;

    /**
     * @return int
     */
    public function getPoint(): int;

    public function serializeItem();

    /**
     * @param ItemRepositoryInterface $itemRepository
     */
    public function unserializeItem(ItemRepositoryInterface $itemRepository);
}
