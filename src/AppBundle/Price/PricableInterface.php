<?php

namespace AppBundle\Price;

use AppBundle\Asset\OwnerableInterface;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface PricableInterface extends OwnerableInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return float
     */
    public function getPrice(): float;

    /**
     * @param float $price
     */
    public function setPrice(float $price);

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
     * @param string $serviceId
     */
    public function setPriceCalculatorServiceId(string $serviceId);
}
