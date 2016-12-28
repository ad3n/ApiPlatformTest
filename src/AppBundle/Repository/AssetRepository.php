<?php

namespace AppBundle\Repository;

use AppBundle\Asset\AssetRepositoryInterface;
use AppBundle\Asset\ResourceInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class AssetRepository implements AssetRepositoryInterface
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $repository;

    /**
     * @param ObjectManager $objectManager
     * @param string $dataClass
     */
    public function __construct(ObjectManager $objectManager, string $dataClass)
    {
        $metadata = $objectManager->getClassMetadata($dataClass);
        $this->repository = $objectManager->getRepository($metadata->getName());
    }

    /**
     * @param string $owner
     * @param int    $sourceId
     *
     * @return ResourceInterface[]
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
     * @return ResourceInterface[]
     */
    public function findByOwnerAndGroup(string $owner, int $sourceId, string $group): array
    {
        return $this->repository->findBy(['owner' => $owner, 'sourceId' => $sourceId, 'group' => $group]);
    }
}
