<?php

namespace AppBundle\Promotion;

use Doctrine\Common\Persistence\ObjectManager;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class PromotionFactory
{
    /**
     * @var PromotionRepositoryInterface
     */
    private $promotionRepository;

    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @param PromotionRepositoryInterface $promotionRepository
     */
    public function __construct(PromotionRepositoryInterface $promotionRepository)
    {
        $this->promotionRepository = $promotionRepository;
    }
    /**
     * @param ObjectManager $objectManager
     */
    public function setManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @param PromotableInterface $promotable
     */
    public function calculateBenefit(PromotableInterface $promotable)
    {
        $this->promotionRepository->setManager($this->objectManager);
        $promotion = $this->promotionRepository->findByCode($promotable->getVoucherCode());
        if ($promotion) {
            $promotion->calculate($promotable);
        }

        foreach ($promotable->getBenefits() as $benefit) {
            $this->objectManager->persist($benefit);
        }

        $this->objectManager->flush();
    }
}
