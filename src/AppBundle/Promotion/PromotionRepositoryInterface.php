<?php

namespace AppBundle\Promotion;

use AppBundle\Repository\RepositoryInterface;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface PromotionRepositoryInterface extends RepositoryInterface
{
    /**
     * @param string $voucherCode
     *
     * @return PromotionInterface|null
     */
    public function findByCode(string $voucherCode);

    /**
     * @return string
     */
    public function getDataClass(): string;
}
