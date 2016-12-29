<?php

namespace AppBundle\Promotion;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface PromotionInterface
{
    /**
     * @return PromotionBenefitInterface
     */
    public function createPromotionBenefit();

    /**
     * @param PromotableInterface $promotable
     */
    public function calculate(PromotableInterface $promotable);
}
