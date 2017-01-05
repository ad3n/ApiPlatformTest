<?php

namespace AppBundle\Repository;

use AppBundle\ShoppingCart\OwnerableInterface;
use AppBundle\ShoppingCart\ShoppingCartInterface;
use AppBundle\ShoppingCart\ShoppingCartRepositoryInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class ShoppingCartRepository implements ShoppingCartRepositoryInterface
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
     * @param string $uniqueId
     *
     * @return ShoppingCartInterface|null
     */
    public function findByUniqueId(string $uniqueId)
    {
        $shoppingCart = $this->repository->findOneBy(['uniqueId' => $uniqueId, 'isProcessed' => false]);

        if ($shoppingCart instanceof ShoppingCartInterface && !$shoppingCart->isProcessed()) {
            return $shoppingCart;
        }

        return null;
    }

    /**
     * @param OwnerableInterface $owner
     *
     * @return ShoppingCartInterface|null
     */
    public function findByOwner(OwnerableInterface $owner)
    {
        $shoppingCart = $this->repository->findOneBy(['transaction' => $owner, 'isProcessed' => false]);

        if ($shoppingCart instanceof ShoppingCartInterface && !$shoppingCart->isProcessed()) {
            return $shoppingCart;
        }

        return null;
    }
}
