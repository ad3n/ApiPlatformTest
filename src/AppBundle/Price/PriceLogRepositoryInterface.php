<?php

namespace AppBundle\Price;

use Doctrine\Common\Persistence\ObjectManager;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface PriceLogRepositoryInterface
{
    /**
     * @param ObjectManager $objectManager
     */
    public function setManager(ObjectManager $objectManager);

    /**
     * @param PricableInterface $owner
     *
     * @return PriceLogInterface[]
     */
    public function findByOwner(PricableInterface $owner);
}
