<?php

namespace AppBundle\Promotion;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class PromotionBenefitSubscriber implements EventSubscriber
{
    /**
     * @var ItemRepositoryInterface
     */
    private $repository;

    /**
     * @param ItemRepositoryInterface $promotionRepository
     */
    public function __construct(ItemRepositoryInterface $promotionRepository)
    {
        $this->repository = $promotionRepository;
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof PromotionBenefitInterface) {
            return;
        }

        $entity->serializeItem();
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof PromotionBenefitInterface) {
            return;
        }

        $entity->serializeItem();
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof PromotionBenefitInterface) {
            return;
        }

        $this->repository->setManager($args->getObjectManager());
        $entity->unserializeItem($this->repository);
    }

    /**
     * @return array
     */
    public function getSubscribedEvents(): array
    {
        return [Events::postLoad, Events::postPersist, Events::postUpdate];
    }
}
