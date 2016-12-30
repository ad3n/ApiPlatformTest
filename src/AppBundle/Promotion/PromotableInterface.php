<?php

namespace AppBundle\Promotion;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface PromotableInterface
{
    /**
     * @param PromotionBenefitInterface $promoBenefit
     */
    public function addBenefit(PromotionBenefitInterface $promoBenefit);

    /**
     * @param PromotionBenefitInterface $promotionBenefit
     *
     * @return PromotionBenefitInterface[]
     */
    public function removeBenefit(PromotionBenefitInterface $promotionBenefit): array;

    /**
     * @param PromotionBenefitInterface[] $benefits
     */
    public function setBenefits(array $benefits);

    /**
     * @return PromotionBenefitInterface[]
     */
    public function getBenefits(): array;

    /**
     * @return string
     */
    public function getVoucherCode(): string;

    /**
     * @param string $voucherCode
     */
    public function setVoucherCode(string $voucherCode);

    /**
     * @return float
     */
    public function getTotalAmount(): float;

    /**
     * @param float $totalAmount
     */
    public function setTotalAmount(float $totalAmount);
}
