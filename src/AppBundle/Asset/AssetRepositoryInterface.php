<?php

namespace AppBundle\Asset;

use AppBundle\Repository\RepositoryInterface;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface AssetRepositoryInterface extends RepositoryInterface
{
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
