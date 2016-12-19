<?php

namespace AppBundle\Asset;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface ResourceRepositoryInterface
{
    /**
     * @param ResourceOwnerInterface $resourceOwner
     *
     * @return array
     */
    public function findByOwner(ResourceOwnerInterface $resourceOwner): array;

    /**
     * @param ResourceOwnerInterface $resourceOwner
     * @param string                 $group
     *
     * @return array
     */
    public function findByOwnerAndGroup(ResourceOwnerInterface $resourceOwner, string $group): array;
}
