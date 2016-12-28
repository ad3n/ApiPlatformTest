<?php

namespace AppBundle\Promotion;

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
     * @var array
     */
    private $promotions;

    /**
     * @param PromotionRepositoryInterface $promotionRepository
     */
    public function __construct(PromotionRepositoryInterface $promotionRepository)
    {
        $this->promotionRepository = $promotionRepository;
    }

    /**
     * @param string             $serviceId
     * @param PromotionInterface $promotion
     */
    public function addPromotion(string $serviceId, PromotionInterface $promotion)
    {
        $this->promotions[$serviceId] = $promotion;
    }

    /**
     * @param PromotableInterface $promotable
     */
    public function calculateBenefit(PromotableInterface $promotable)
    {
        $promotion = $this->promotionRepository->findByCode($promotable->getVoucherCode());
        if ($promotion) {
            $promotion->calculate($promotable);
        }
    }
}
