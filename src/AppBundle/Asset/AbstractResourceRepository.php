<?php

namespace AppBundle\Asset;

use Doctrine\Common\Persistence\ObjectRepository;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
abstract class AbstractResourceRepository implements ResourceRepositoryInterface
{
    /**
     * @return ObjectRepository
     */
    abstract protected function getRepository();

    /**
     * @param ResourceOwnerInterface $resourceOwner
     *
     * @return array
     */
    public function findByOwner(ResourceOwnerInterface $resourceOwner): array
    {
        return $this->getRepository()->findBy(['owner' => $resourceOwner->serialize()]);
    }

    /**
     * @param ResourceOwnerInterface $resourceOwner
     * @param string                 $group
     *
     * @return array
     */
    public function findByOwnerAndGroup(ResourceOwnerInterface $resourceOwner, string $group): array
    {
        return $this->getRepository()->findBy(['owner' => $resourceOwner->serialize(), 'group' => $group]);
    }
}
