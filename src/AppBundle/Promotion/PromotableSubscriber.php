<?php

namespace AppBundle\Promotion;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class PromotableSubscriber implements EventSubscriber
{
    /**
     * @var PromotionBenefitRepositoryInterface
     */
    private $repository;

    /**
     * @var PromotionFactory
     */
    private $promotionFactory;

    /**
     * @param PromotionBenefitRepositoryInterface $promotionBenefitRepository
     * @param PromotionFactory                    $promotionFactory
     */
    public function __construct(PromotionBenefitRepositoryInterface $promotionBenefitRepository, PromotionFactory $promotionFactory)
    {
        $this->repository = $promotionBenefitRepository;
        $this->promotionFactory = $promotionFactory;
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof PromotableInterface) {
            return;
        }

        $this->repository->setManager($args->getObjectManager());
        $entity->setBenefits($this->repository->findByOwner($entity));
    }

    /**
     * @param LifecycleEventArgs $eventArgs
     */
    public function postPersist(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();
        if (!$entity instanceof PromotableInterface) {
            return;
        }

        $this->promotionFactory->setManager($eventArgs->getObjectManager());
        $this->promotionFactory->calculateBenefit($entity);
    }

    /**
     * @param LifecycleEventArgs $eventArgs
     */
    public function postUpdate(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();
        if (!$entity instanceof PromotableInterface) {
            return;
        }

        $this->promotionFactory->setManager($eventArgs->getObjectManager());
        $this->promotionFactory->calculateBenefit($entity);
    }

    /**
     * @return array
     */
    public function getSubscribedEvents(): array
    {
        return [Events::postLoad, Events::postPersist, Events::postUpdate];
    }
}
