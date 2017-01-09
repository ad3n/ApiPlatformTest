<?php

namespace AppBundle\Repository;

use AppBundle\Price\PricableInterface;
use AppBundle\Price\PriceLogInterface;
use AppBundle\Price\PriceLogRepositoryInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class PriceLogRepository implements PriceLogRepositoryInterface
{
    /**
     * @var ObjectRepository
     */
    private $repository;

    /**
     * @var string
     */
    private $dataClass;

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
     * @param PricableInterface $owner
     *
     * @return PriceLogInterface[]
     */
    public function findByOwner(PricableInterface $owner): array
    {
        return $this->repository->findBy(['owner' => get_class($owner), 'sourceId' => $owner->getId()]);
    }
}
