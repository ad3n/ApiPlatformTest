<?php

namespace AppBundle\Repository;

use AppBundle\Asset\AssetRepositoryInterface;
use AppBundle\Asset\AssetInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class AssetRepository implements AssetRepositoryInterface
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
     * @param string $owner
     * @param int    $sourceId
     *
     * @return AssetInterface[]
     */
    public function findByOwner(string $owner, int $sourceId): array
    {
        return $this->repository->findBy(['owner' => $owner, 'sourceId' => $sourceId]);
    }

    /**
     * @param string $owner
     * @param int    $sourceId
     * @param string $group
     *
     * @return AssetInterface[]
     */
    public function findByOwnerAndGroup(string $owner, int $sourceId, string $group): array
    {
        return $this->repository->findBy(['owner' => $owner, 'sourceId' => $sourceId, 'group' => $group]);
    }
}
