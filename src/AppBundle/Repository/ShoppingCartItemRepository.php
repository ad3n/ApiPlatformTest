<?php

namespace AppBundle\Repository;

use AppBundle\ShoppingCart\ShoppingCartInterface;
use AppBundle\ShoppingCart\ShoppingCartItemInterface;
use AppBundle\ShoppingCart\ShoppingCartItemRepositoryInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class ShoppingCartItemRepository implements ShoppingCartItemRepositoryInterface
{
    /**
     * @var string
     */
    private $dataClass;

    /**
     * @var ObjectRepository
     */
    private $repository;

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
     * @param ShoppingCartInterface $owner
     *
     * @return ShoppingCartItemInterface[]
     */
    public function findByOwner(ShoppingCartInterface $owner)
    {
        return $this->repository->findBy(['owner' => $owner]);
    }
}
