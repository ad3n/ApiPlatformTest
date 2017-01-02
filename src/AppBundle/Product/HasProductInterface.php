<?php

namespace AppBundle\Product;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface HasProductInterface
{
    /**
     * @return int
     */
    public function getProductId(): int;

    /**
     * @return string
     */
    public function getProductSource(): string;

    /**
     * @return string
     */
    public function getProductClass(): string;

    /**
     * @return ProductInterface|null
     */
    public function getProduct();

    /**
     * @param ProductInterface $product
     */
    public function setProduct(ProductInterface $product);
}
