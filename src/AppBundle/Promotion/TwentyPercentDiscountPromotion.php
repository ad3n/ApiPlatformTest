<?php

namespace AppBundle\Promotion;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class TwentyPercentDiscountPromotion implements PromotionInterface
{
    /**
     * @var string
     */
    private $promotionBenefitClass;

    /**
     * @param string $promotionBenefitClass
     */
    public function __construct(string $promotionBenefitClass)
    {
        $this->promotionBenefitClass = $promotionBenefitClass;
    }

    /**
     * @param PromotableInterface $promotable
     */
    public function calculate(PromotableInterface $promotable)
    {
        $totalAmount = $promotable->getTotalAmount();
        $discount = ($totalAmount * 0.2);
        $promotable->setTotalAmount($totalAmount - $discount);
        $promotable->setDiscount($discount);

        $promoBenefit = $this->createPromotionBenefit();
        $promoBenefit->setName('Twenty percent discount per transaction');
        $promoBenefit->setDescription('Twenty percent discount applied per transaction not per product');
        $promoBenefit->setDiscountPercentage(20.0);

        $promotable->addBenefit($promoBenefit);
    }

    /**
     * @return PromotionBenefitInterface
     */
    public function createPromotionBenefit()
    {
        return new $this->promotionBenefitClass();
    }
}
