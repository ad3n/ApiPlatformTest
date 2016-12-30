<?php

namespace AppBundle\Promotion;

use Doctrine\Common\Persistence\ObjectManager;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface PromotionBenefitRepositoryInterface
{
    /**
     * @param ObjectManager $objectManager
     */
    public function setManager(ObjectManager $objectManager);

    /**
     * @param PromotableInterface $owner
     *
     * @return PromotionBenefitInterface[]
     */
    public function findByOwner(PromotableInterface $owner): array;
}
