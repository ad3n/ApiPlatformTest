<?php

namespace AppBundle\Repository;

use AppBundle\Product\ProductInterface;
use AppBundle\Product\ProductRepositoryInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class DiamondRepository implements ProductRepositoryInterface
{
    /**
     * @var ObjectRepository
     */
    private $repository;

    /**
     * @var string
     */
    private $dataClass;

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
     * @param int $id
     *
     * @return ProductInterface|null
     */
    public function find(int $id)
    {
        $product = $this->repository->find($id);
        if ($product instanceof ProductInterface) {
            return $product;
        }

        return null;
    }

    /**
     * @return string
     */
    public function getProductClass()
    {
        return $this->dataClass;
    }
}
