<?php

namespace AppBundle\Product;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface DiamondInterface
{
    /**
     * @return float
     */
    public function getCarat(): float;

    /**
     * @return float
     */
    public function getPrice(): float;
}
