<?php

namespace AppBundle\ShoppingCart;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface ShoppingCartRepositoryInterface
{
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
