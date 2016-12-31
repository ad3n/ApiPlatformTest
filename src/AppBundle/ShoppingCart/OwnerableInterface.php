<?php

namespace AppBundle\ShoppingCart;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface OwnerableInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @param ShoppingCartInterface $shoppingCart
     */
    public function setShoppingCart(ShoppingCartInterface $shoppingCart);

    /**
     * @return ShoppingCartInterface
     */
    public function getShoppingCart();
}
