<?php

namespace AppBundle\Product;

use AppBundle\Repository\RepositoryInterface;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface ProductRepositoryInterface extends RepositoryInterface
{
    /**
     * @param int $id
     *
     * @return ProductInterface|null
     */
    public function find(int $id);

    /**
     * @return string
     */
    public function getProductClass();
}
