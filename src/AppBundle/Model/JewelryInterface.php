<?php

namespace AppBundle\Model;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface JewelryInterface
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
