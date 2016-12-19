<?php

namespace AppBundle\Price;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface PriceCalculatorInterface
{
    /**
     * @param PricableInterface $pricable
     *
     * @return float
     */
    public function calculate(PricableInterface $pricable);
}
