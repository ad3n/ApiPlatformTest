<?php

namespace AppBundle\Promotion;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class TwentyPercentDiscountPromotion implements PromotionInterface
{
    /**
     * @param PromotableInterface $promotable
     */
    public function calculate(PromotableInterface $promotable)
    {
        $totalAmount = $promotable->getTotalAmount();
        $promotable->setTotalAmount($totalAmount - ($totalAmount * 0.2));

        $promoBenefit = new PromotionBenefit();
        $promoBenefit->setName('Twenty percent discount per transaction');
        $promoBenefit->setDescription('Twenty percent discount applied per transaction not per product');
        $promoBenefit->setDiscountPercentage(20.0);

        $promotable->addBenefit($promoBenefit);
        $promotable->serializeBenefit();
    }
}
