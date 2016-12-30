<?php

namespace AppBundle\Promotion;

use AppBundle\Repository\RepositoryInterface;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface ItemRepositoryInterface extends RepositoryInterface
{
    /**
     * @param int $id
     *
     * @return ItemInterface|null
     */
    public function find(int $id);
}
