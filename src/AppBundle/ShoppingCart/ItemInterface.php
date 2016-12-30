<?php

namespace AppBundle\ShoppingCart;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface ItemInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @return float
     */
    public function getPrice(): float;

    /**
     * @return float
     */
    public function getTax(): float;
}
