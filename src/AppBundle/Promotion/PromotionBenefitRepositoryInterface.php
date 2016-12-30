<?php

namespace AppBundle\Promotion;

use AppBundle\Repository\RepositoryInterface;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface PromotionBenefitRepositoryInterface extends RepositoryInterface
{
    /**
     * @param PromotableInterface $owner
     *
     * @return PromotionBenefitInterface[]
     */
    public function findByOwner(PromotableInterface $owner): array;
}
