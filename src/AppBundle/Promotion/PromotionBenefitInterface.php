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
     * @return PromotableInterface
     */
    public function getOwner(): PromotableInterface;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     */
    public function setName(string $name);

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @param string $description
     */
    public function setDescription(string $description);

    /**
     * @return ItemInterface[]
     */
    public function getItems(): array;

    /**
     * @param ItemInterface $item
     */
    public function addItem(ItemInterface $item);

    /**
     * @return float
     */
    public function getDiscountValue(): float;

    /**
     * @param float $discountValue
     */
    public function setDiscountValue(float $discountValue);

    /**
     * @return float
     */
    public function getDiscountPercentage(): float;

    /**
     * @param float $discountPercentage
     */
    public function setDiscountPercentage(float $discountPercentage);

    /**
     * @return float
     */
    public function getCashback(): float;

    /**
     * @param float $cashback
     */
    public function setCashback(float $cashback);

    /**
     * @return ProductInterface
     */
    public function getProduct(): ProductInterface;

    /**
     * @param ProductInterface $product
     */
    public function setProduct(ProductInterface $product);

    /**
     * @return string
     */
    public function getVoucher(): string;

    /**
     * @param string $voucher
     */
    public function setVoucher(string $voucher);

    /**
     * @return int
     */
    public function getPoint(): int;

    /**
     * @param int $point
     */
    public function setPoint(int $point);

    public function serializeItem();

    /**
     * @param ItemRepositoryInterface $itemRepository
     */
    public function unserializeItem(ItemRepositoryInterface $itemRepository);
}
