<?php

namespace AppBundle\Promotion;

use Doctrine\Common\Persistence\ObjectManager;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface PromotionRepositoryInterface
{
    /**
     * @param ObjectManager $objectManager
     */
    public function setManager(ObjectManager $objectManager);

    /**
     * @param string $voucherCode
     *
     * @return PromotionInterface|null
     */
    public function findByCode(string $voucherCode);

    /**
     * @param OwnerableInterface $owner
     *
     * @return PromotableInterface[]
     */
    public function findByOwner(OwnerableInterface $owner);

    /**
     * @return string
     */
    public function getDataClass(): string;
}
