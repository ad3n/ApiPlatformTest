<?php

namespace AppBundle\Repositroy;

use AppBundle\Promotion\PromotionDataInterface;
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
     * @param ObjectManager $objectManager
     * @param string        $dataClass
     */
    public function __construct(ObjectManager $objectManager, string $dataClass)
    {
        $metadata = $objectManager->getClassMetadata($dataClass);
        $this->dataClass = $metadata->getName();
        $this->repository = $objectManager->getRepository($this->dataClass);
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
    public function findByCode(string $voucherCode)
    {
        /** @var PromotionDataInterface $promotionData */
        $promotionData = $this->repository->findOneBy(['voucherCode' => $voucherCode]);
        if ($promotionData->isValid()) {
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
