<?php

namespace AppBundle\Repository;

use AppBundle\Promotion\OwnerableInterface;
use AppBundle\Promotion\PromotableInterface;
use AppBundle\Promotion\PromotionInterface;
use AppBundle\Promotion\PromotionRepositoryInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class PromotionRepository implements PromotionRepositoryInterface, ContainerAwareInterface
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
     * @var ContainerInterface
     */
    private $container;

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
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param string $voucherCode
     *
     * @return PromotionInterface|null
     */
    public function findByCode(string $voucherCode): PromotionInterface
    {
        /** @var OwnerableInterface $promotionData */
        $promotionData = $this->repository->findOneBy(['voucherCode' => $voucherCode]);
        if ($promotionData && $promotionData->isValid()) {
            /** @var PromotionInterface $promotion */
            $promotion = $this->container->get($promotionData->getServiceId());

            return $promotion;
        }

        return null;
    }

    /**
     * @return string
     */
    public function getDataClass(): string
    {
        return $this->dataClass;
    }
}
