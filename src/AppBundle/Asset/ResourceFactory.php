<?php

namespace AppBundle\Asset;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class ResourceFactory
{
    /**
     * @var ResourceRepositoryInterface
     */
    private $repository;

    /**
     * @param ResourceRepositoryInterface $repository
     */
    public function __construct(ResourceRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param ResourceOwnerInterface $resourceOwner
     *
     * @return array
     */
    public function findByOwner(ResourceOwnerInterface $resourceOwner): array
    {
        return $this->repository->findByOwner($resourceOwner);
    }
}
