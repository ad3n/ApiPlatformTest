<?php

namespace AppBundle\Price;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class PriceWithoutTaxCalculator implements PriceCalculatorInterface
{
    /**
     * @param PricableInterface $pricable
     */
    public function calculate(PricableInterface $pricable)
    {
        $pricable->setPrice($pricable->getPrice());
        $pricable->setTax(0);
    }
}
