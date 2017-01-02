<?php

namespace AppBundle\ShoppingCart;

use AppBundle\Product\ProductRepositoryInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class ShoppingCartItemSubscriber implements EventSubscriber
{
    /**
     * @var ProductRepositoryInterface
     */
    private $repository;

    /**
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->repository = $productRepository;
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof ShoppingCartItemInterface) {
            return;
        }

        $product = $this->repository->find($entity->getProductId());
        $entity->setProduct($product);
    }

    /**
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [Events::postLoad];
    }
}
