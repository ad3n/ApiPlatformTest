<?php

namespace AppBundle\Model;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface TransactionInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return \DateTime
     */
    public function getDateTime(): \DateTime;

    /**
     * @param \DateTime $dateTime
     */
    public function setDateTime(\DateTime $dateTime);
}
