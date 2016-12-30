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
     * @param PromotionBenefitRepositoryInterface $promotionBenefitRepository
     */
    public function __construct(PromotionBenefitRepositoryInterface $promotionBenefitRepository)
    {
        $this->repository = $promotionBenefitRepository;
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
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [Events::postLoad];
    }
}
