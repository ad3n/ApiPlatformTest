<?php

namespace AppBundle\ShoppingCart;

use Doctrine\Common\Persistence\ObjectManager;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface ShoppingCartRepositoryInterface
{
    /**
     * @param ObjectManager $objectManager
     */
    public function setManager(ObjectManager $objectManager);

    /**
     * @param string $uniqueId
     *
     * @return ShoppingCartInterface|null
     */
    public function findByUniqueId(string $uniqueId);

    /**
     * @param OwnerableInterface $owner
     *
     * @return ShoppingCartInterface|null
     */
    public function findByOwner(OwnerableInterface $owner);
}
