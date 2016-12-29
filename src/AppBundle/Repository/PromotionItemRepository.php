<?php

namespace AppBundle\Repository;

use AppBundle\Promotion\ItemInterface;
use AppBundle\Promotion\ItemRepositoryInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class PromotionItemRepository implements ItemRepositoryInterface
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
     * @param int $id
     *
     * @return ItemInterface|null
     */
    public function find(int $id)
    {
        $item = $this->repository->find($id);
        if ($item instanceof ItemInterface) {
            return $item;
        }

        return null;
    }
}
