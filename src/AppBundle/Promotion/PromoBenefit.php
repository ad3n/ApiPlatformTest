<?php

namespace AppBundle\Promotion;

use AppBundle\Product\ProductInterface;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class PromoBenefit
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var array
     */
    private $items;

    /**
     * @var float
     */
    private $discountValue;

    /**
     * @var float
     */
    private $discountPercentage;

    /**
     * @var float
     */
    private $cashback;

    /**
     * @var ProductInterface
     */
    private $product;

    /**
     * @var string
     */
    private $voucher;

    /**
     * @var int
     */
    private $point;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return ItemInterface[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param ItemInterface $item
     */
    public function addItem(ItemInterface $item)
    {
        $this->items[$item->getId()] = $item;
    }

    /**
     * @param ItemInterface $item
     *
     * @return ItemInterface[]
     */
    public function removeItem(ItemInterface $item): array
    {
        unset($this->items[$item->getId()]);

        return $this->items;
    }

    /**
     * @return float
     */
    public function getDiscountValue(): float
    {
        return $this->discountValue;
    }

    /**
     * @param float $discountValue
     */
    public function setDiscountValue(float $discountValue)
    {
        $this->discountValue = $discountValue;
    }

    /**
     * @return float
     */
    public function getDiscountPercentage(): float
    {
        return $this->discountPercentage;
    }

    /**
     * @param float $discountPercentage
     */
    public function setDiscountPercentage(float $discountPercentage)
    {
        $this->discountPercentage = $discountPercentage;
    }

    /**
     * @return float
     */
    public function getCashback(): float
    {
        return $this->cashback;
    }

    /**
     * @param float $cashback
     */
    public function setCashback(float $cashback)
    {
        $this->cashback = $cashback;
    }

    /**
     * @return ProductInterface
     */
    public function getProduct(): ProductInterface
    {
        return $this->product;
    }

    /**
     * @param ProductInterface $product
     */
    public function setProduct(ProductInterface $product)
    {
        $this->product = $product;
    }

    /**
     * @return string
     */
    public function getVoucher(): string
    {
        return $this->voucher;
    }

    /**
     * @param string $voucher
     */
    public function setVoucher(string $voucher)
    {
        $this->voucher = $voucher;
    }

    /**
     * @return int
     */
    public function getPoint(): int
    {
        return $this->point;
    }

    /**
     * @param int $point
     */
    public function setPoint(int $point)
    {
        $this->point = $point;
    }
}
