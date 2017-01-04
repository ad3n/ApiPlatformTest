<?php

namespace AppBundle\ShoppingCart;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class ShoppingCartSubscriber implements EventSubscriber
{
    /**
     * @var ShoppingCartItemRepositoryInterface
     */
    private $repository;

    /**
     * @param ShoppingCartItemRepositoryInterface $shoppingCartItemRepository
     */
    public function __construct(ShoppingCartItemRepositoryInterface $shoppingCartItemRepository)
    {
        $this->repository = $shoppingCartItemRepository;
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof ShoppingCartInterface) {
            return;
        }

        $this->repository->setManager($args->getObjectManager());
        $entity->setItems($this->repository->findByOwner($entity));
    }

    /**
     * @return array
     */
    public function getSubscribedEvents(): array
    {
        return [Events::postLoad];
    }
}
