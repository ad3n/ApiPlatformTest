<?php

namespace AppBundle\Repository;

use AppBundle\Transaction\OwnerableInterface;
use AppBundle\Transaction\TransactionInterface;
use AppBundle\Transaction\TransactionRepositoryInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class TransactionRepository implements TransactionRepositoryInterface
{
    /**
     * @var string
     */
    private $dataClass;

    /**
     * @var ObjectRepository
     */
    private $repository;

    /**
     * @param string $dataClass
     */
    public function __construct(string $dataClass)
    {
        $this->dataClass = $dataClass;
    }

    /**
     * @param ObjectManager $objectManager
     */
    public function setManager(ObjectManager $objectManager)
    {
        $metadata = $objectManager->getClassMetadata($this->dataClass);
        $this->repository = $objectManager->getRepository($metadata->getName());
    }

    /**
     * @param OwnerableInterface $owner
     *
     * @return TransactionInterface[]
     */
    public function findByOwner(OwnerableInterface $owner)
    {
        return $this->repository->findBy(['owner' => $owner]);
    }
}
