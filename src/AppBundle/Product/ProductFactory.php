<?php

namespace AppBundle\Product;

use Doctrine\Common\Persistence\ObjectManager;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class ProductFactory
{
    /**
     * @var ProductRepositoryInterface[]
     */
    private $repositories;

    /**
     * @var ObjectManager
     */
    private $manager;

    /**
     * @param ProductRepositoryInterface $productRepository
     */
    public function addRepository(ProductRepositoryInterface $productRepository)
    {
        $this->repositories[$productRepository->getProductClass()] = $productRepository;
    }

    /**
     * @param ObjectManager $objectManager
     */
    public function setManager(ObjectManager $objectManager)
    {
        $this->manager = $objectManager;
    }

    /**
     * @param int    $id
     * @param string $source
     *
     * @return ProductInterface|null
     */
    public function getProduct(int $id, string $source)
    {
        if (!in_array($source, array_keys($this->repositories))) {
            return null;
        }

        /** @var ProductRepositoryInterface $repository */
        $repository = $this->repositories[$source];
        $repository->setManager($this->manager);

        return $repository->find($id);
    }
}
