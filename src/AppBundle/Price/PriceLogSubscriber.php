<?php

namespace AppBundle\Price;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class PriceLogSubscriber implements EventSubscriber
{
    /**
     * @var PriceLogRepositoryInterface
     */
    private $repository;

    /**
     * @param PriceLogRepositoryInterface $priceLogRepository
     */
    public function __construct(PriceLogRepositoryInterface $priceLogRepository)
    {
        $this->repository = $priceLogRepository;
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof PricableInterface) {
            return;
        }

        $this->repository->setManager($args->getObjectManager());
        $entity->setPriceHistories($this->repository->findByOwner($entity));
    }

    /**
     * @return array
     */
    public function getSubscribedEvents(): array
    {
        return [Events::postLoad];
    }
}
