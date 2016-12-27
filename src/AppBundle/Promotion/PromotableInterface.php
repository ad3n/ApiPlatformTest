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

    public function compileBenefit();
}
