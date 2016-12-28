<?php

namespace AppBundle\Promotion;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface PromotionRepositoryInterface
{
    /**
     * @param $voucherCode
     *
     * @return PromotionInterface|null
     */
    public function findByCode($voucherCode);

    /**
     * @return string
     */
    public function getDataClass(): string;
}
