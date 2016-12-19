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
     * @return float
     */
    public function getPrice(): float;

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
