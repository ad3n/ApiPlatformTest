<?php

namespace AppBundle\ShoppingCart;

use AppBundle\Repository\RepositoryInterface;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface ShoppingCartRepositoryInterface extends RepositoryInterface
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
