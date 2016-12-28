<?php

namespace AppBundle\Promotion;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface PromotionInterface
{
    /**
     * @param PromotableInterface $promotable
     */
    public function calculate(PromotableInterface $promotable);
}
