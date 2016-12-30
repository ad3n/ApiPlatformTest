<?php

namespace AppBundle\ShoppingCart;

use AppBundle\Repository\RepositoryInterface;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface ShoppingCartItemRepositoryInterface extends RepositoryInterface
{
    /**
     * @param ShoppingCartInterface $owner
     *
     * @return ShoppingCartItemInterface[]
     */
    public function findByOwner(ShoppingCartInterface $owner);
}
