<?php

namespace AppBundle\Asset;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface OwnerableInterface
{
    /**
     * @return string
     */
    public function getOwnerId(): string;
}
