<?php

namespace AppBundle\Repository;

use Doctrine\Common\Persistence\ObjectManager;

interface RepositoryInterface
{
    /**
     * @param ObjectManager $objectManager
     */
    public function setManager(ObjectManager $objectManager);
}
