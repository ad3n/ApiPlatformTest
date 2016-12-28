<?php

namespace AppBundle\Asset;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface AssetRepositoryInterface
{
    /**
     * @param string $owner
     * @param int    $sourceId
     *
     * @return ResourceInterface[]
     */
    public function findByOwner(string $owner, int $sourceId): array;

    /**
     * @param string $owner
     * @param int    $sourceId
     * @param string $group
     *
     * @return ResourceInterface[]
     */
    public function findByOwnerAndGroup(string $owner, int $sourceId, string $group): array;
}
