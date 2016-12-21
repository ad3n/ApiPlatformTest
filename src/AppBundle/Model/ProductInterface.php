<?php

namespace AppBundle\Model;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface ProductInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return SupplierInterface
     */
    public function getSupplier(): SupplierInterface;

    /**
     * @return string
     */
    public function getSupplierCode(): string;

    /**
     * @return string
     */
    public function getCode(): string;

    /**
     * @return string
     */
    public function getSku(): string;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getAlternateName(): string;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @param float $price
     */
    public function setPrice(float $price);

    /**
     * @return float
     */
    public function getPrice(): float;

    /**
     * @param float $tax
     */
    public function setTax(float $tax);

    /**
     * @return float
     */
    public function getTax(): float;

    /**
     * @return string
     */
    public function getPriceCalculatorServiceId(): string;

    /**
     * @return int
     */
    public function getQuantity(): int;

    /**
     * @return bool
     */
    public function isShow(): bool;
}
