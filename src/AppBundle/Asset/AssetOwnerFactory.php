<?php

namespace AppBundle\Asset;

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
     * @param AssetRepositoryInterface $assetRepository
     */
    public function addAssetOwnerRepository(AssetRepositoryInterface $assetRepository)
    {
        $this->assetOwnerRepositories[] = $assetRepository;
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
            array_merge($assets, $assetOwnerRepository->findByOwnerAndGroup($owner, $sourceId, $group));
        }

        return $assets;
    }
}
