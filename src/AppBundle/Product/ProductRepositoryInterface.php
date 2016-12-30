<?php

namespace AppBundle\Product;

use Doctrine\Common\Persistence\ObjectManager;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface ProductRepositoryInterface
{
    /**
     * @param ObjectManager $objectManager
     */
    public function setManager(ObjectManager $objectManager);

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
