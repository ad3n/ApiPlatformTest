<?php

namespace AppBundle\ShoppingCart;

use Doctrine\Common\Persistence\ObjectManager;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface ShoppingCartItemRepositoryInterface
{
    /**
     * @param ObjectManager $objectManager
     */
    public function setManager(ObjectManager $objectManager);

    /**
     * @param ShoppingCartInterface $owner
     *
     * @return ShoppingCartItemInterface[]
     */
    public function findByOwner(ShoppingCartInterface $owner);
}
