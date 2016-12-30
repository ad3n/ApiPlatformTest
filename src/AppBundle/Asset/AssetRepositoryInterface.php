<?php

namespace AppBundle\Asset;

use Doctrine\Common\Persistence\ObjectManager;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface AssetRepositoryInterface
{
    /**
     * @param ObjectManager $objectManager
     */
    public function setManager(ObjectManager $objectManager);

    /**
     * @param string $owner
     * @param int    $sourceId
     *
     * @return AssetInterface[]
     */
    public function findByOwner(string $owner, int $sourceId): array;

    /**
     * @param string $owner
     * @param int    $sourceId
     * @param string $group
     *
     * @return AssetInterface[]
     */
    public function findByOwnerAndGroup(string $owner, int $sourceId, string $group): array;
}
