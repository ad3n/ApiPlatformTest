<?php

namespace AppBundle\Promotion;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface PromotableInterface
{
    /**
     * @param PromoBenefit $promoBenefit
     */
    public function addBenefit(PromoBenefit $promoBenefit);

    /**
     * @return string
     */
    public function getVoucherCode(): string;

    /**
     * @param string $voucherCode
     */
    public function setVoucherCode(string $voucherCode);

    /**
     * @return string
     */
    public function serializeBenefit(): string;

    /**
     * @param string $string
     *
     * @return PromoBenefit[]
     */
    public function unserializeBenefit(string $string = null): array;

    /**
     * @return float
     */
    public function getTotalAmount(): float;

    /**
     * @param float $totalAmount
     */
    public function setTotalAmount(float $totalAmount);
}
