<?php

namespace AppBundle\Price;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface PricableInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return float
     */
    public function getBasePrice(): float;

    /**
     * @param float $basePrice
     */
    public function setBasePrice(float $basePrice);

    /**
     * @return int
     */
    public function getMarkupMargin(): int;

    /**
     * @return float
     */
    public function getMarkupPrice(): float;

    /**
     * @param float $markupPrice
     */
    public function setMarkupPrice(float $markupPrice);

    /**
     * @return int
     */
    public function getProfitMargin(): int;

    /**
     * @param int $profitMargin
     */
    public function setProfitMargin(int $profitMargin);

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

    /**
     * @param PriceLogInterface $priceLog
     */
    public function addPriceHistory(PriceLogInterface $priceLog);

    /**
     * @param PriceLogInterface[] $priceLogs
     */
    public function setPriceHistories(array $priceLogs);

    /**
     * @return PriceLogInterface[]
     */
    public function getPriceHistories(): array;
}
