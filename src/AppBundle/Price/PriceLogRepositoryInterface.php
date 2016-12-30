<?php

namespace AppBundle\Price;

use AppBundle\Repository\RepositoryInterface;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface PriceLogRepositoryInterface extends RepositoryInterface
{
    /**
     * @param PricableInterface $owner
     *
     * @return PriceLogInterface[]
     */
    public function findByOwner(PricableInterface $owner);
}
