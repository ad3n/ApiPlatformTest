<?php

namespace AppBundle\Price;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface PriceLogInterface
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

    /**
     * @param PricableInterface $pricable
     */
    public function setSource(PricableInterface $pricable);

    /**
     * @return PricableInterface
     */
    public function getSource(): PricableInterface;

    /**
     * @return string
     */
    public function serialize(): string;

    /**
     * @param string $string
     *
     * @return PriceLogInterface
     */
    public function unserialize(string $string): PriceLogInterface;
}
