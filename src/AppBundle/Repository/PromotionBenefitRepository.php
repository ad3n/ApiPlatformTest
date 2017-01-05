<?php

namespace AppBundle\Repository;

use AppBundle\Promotion\PromotableInterface;
use AppBundle\Promotion\PromotionBenefitInterface;
use AppBundle\Promotion\PromotionBenefitRepositoryInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class PromotionBenefitRepository implements PromotionBenefitRepositoryInterface
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
     * @param PromotableInterface $owner
     *
     * @return PromotionBenefitInterface[]
     */
    public function findByOwner(PromotableInterface $owner): array
    {
        return $this->repository->findBy(['transaction' => $owner]);
    }
}
