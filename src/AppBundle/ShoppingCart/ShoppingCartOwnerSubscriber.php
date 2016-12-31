<?php

namespace AppBundle\ShoppingCart;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class ShoppingCartOwnerSubscriber implements EventSubscriber
{
    /**
     * @var ShoppingCartRepositoryInterface
     */
    private $repository;

    /**
     * @param ShoppingCartRepositoryInterface $shoppingCartRepository
     */
    public function __construct(ShoppingCartRepositoryInterface $shoppingCartRepository)
    {
        $this->repository = $shoppingCartRepository;
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof OwnerableInterface) {
            return;
        }

        $this->repository->setManager($args->getObjectManager());
        $shoppingCart = $this->repository->findByOwner($entity);
        if ($shoppingCart) {
            $entity->setShoppingCart($shoppingCart);
        }
    }

    /**
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [Events::postLoad];
    }
}
