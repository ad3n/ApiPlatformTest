<?php

namespace AppBundle\Asset;

use Doctrine\Common\Persistence\ObjectManager;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class AssetOwnerFactory
{
    /**
     * @var array
     */
    private $assetOwnerRepositories;

    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @param AssetRepositoryInterface $assetRepository
     */
    public function addAssetOwnerRepository(AssetRepositoryInterface $assetRepository)
    {
        $this->assetOwnerRepositories[] = $assetRepository;
    }

    /**
     * @param ObjectManager $objectManager
     */
    public function setManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @param string $owner
     * @param int    $sourceId
     *
     * @return ResourceInterface[]
     */
    public function findByOwner(string $owner, int $sourceId): array
    {
        $assets = [];
        /** @var AssetRepositoryInterface $assetOwnerRepository */
        foreach ($this->assetOwnerRepositories as $assetOwnerRepository) {
            $assetOwnerRepository->setManager($this->objectManager);
            array_merge($assets, $assetOwnerRepository->findByOwner($owner, $sourceId));
        }

        return $assets;
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
        $assets = [];
        /** @var AssetRepositoryInterface $assetOwnerRepository */
        foreach ($this->assetOwnerRepositories as $assetOwnerRepository) {
            $assetOwnerRepository->setManager($this->objectManager);
            array_merge($assets, $assetOwnerRepository->findByOwnerAndGroup($owner, $sourceId, $group));
        }

        return $assets;
    }
}
