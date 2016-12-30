<?php

namespace AppBundle\ShoppingCart;

use AppBundle\Product\ProductInterface;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface ShoppingCartItemInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return ShoppingCartInterface
     */
    public function getOwner(): ShoppingCartInterface;

    /**
     * @return ProductInterface
     */
    public function getProduct(): ProductInterface;

    /**
     * @return int
     */
    public function getQuantity(): int;

    /**
     * @param string $key
     * @param string $value
     */
    public function addMetadata(string $key, string $value);

    /**
     * @param array $metadata
     */
    public function setMetadata(array $metadata);

    /**
     * @return array
     */
    public function getMetadata(): array;
}
