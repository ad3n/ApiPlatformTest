<?php

namespace AppBundle\Transaction;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class TransactionOwnerSubscriber implements EventSubscriber
{
    /**
     * @var TransactionRepositoryInterface
     */
    private $repository;

    /**
     * @param TransactionRepositoryInterface $transactionRepository
     */
    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->repository = $transactionRepository;
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
        $entity->setTransactions($this->repository->findByOwner($entity));
    }

    /**
     * @return array
     */
    public function getSubscribedEvents(): array
    {
        return [Events::postLoad];
    }
}
