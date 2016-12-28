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
     * @return array
     */
    public function unserializeBenefit(string $string = null): array;
}
