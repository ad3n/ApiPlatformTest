<?php

namespace AppBundle\ShoppingCart;

use AppBundle\Product\HasProductInterface;
use AppBundle\Product\ProductFactory;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class ShoppingCartItemSubscriber implements EventSubscriber
{
    /**
     * @var ShoppingCartItemRepositoryInterface
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var ProductFactory
     */
    private $productFactory;

    /**
     * @param ShoppingCartItemRepositoryInterface $shoppingCartItemRepository
     * @param ProductFactory $productFactory
     */
    public function __construct(ShoppingCartItemRepositoryInterface $shoppingCartItemRepository, ProductFactory $productFactory)
    {
        $this->repository = $shoppingCartItemRepository;
        $this->productFactory = $productFactory;
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof ShoppingCartItemInterface) {
            return;
        }

        $this->objectManager = $args->getObjectManager();

        $this->updateShoppingCart($entity);
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof ShoppingCartItemInterface) {
            return;
        }

        $this->objectManager = $args->getObjectManager();

        $this->updateShoppingCart($entity);
    }

    /**
     * @param ShoppingCartItemInterface $shoppingCartItem
     */
    private function updateShoppingCart(ShoppingCartItemInterface $shoppingCartItem)
    {
        $shoppingCart = $shoppingCartItem->getOwner();
        if (!$shoppingCartItem instanceof HasProductInterface) {
            return;
        }

        $this->productFactory->setManager($this->objectManager);
        $product = $this->productFactory->getProduct($shoppingCartItem->getProductId(), $shoppingCartItem->getProductClass());
        if ($product && $shoppingCart) {
            $shoppingCart->setSubTotal($shoppingCart->getSubTotal() + ($shoppingCartItem->getQuantity() * $product->getPrice()));
            $shoppingCart->setTax($shoppingCart->getTax() + $product->getTax());

            $shoppingCart->setTotalAmount($shoppingCart->getSubTotal() + $shoppingCart->getTax());
        }

        $this->objectManager->persist($shoppingCart);
        $this->objectManager->flush();
    }

    /**
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [Events::postPersist, Events::postUpdate];
    }
}
