<?php

namespace AppBundle\Promotion;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface PromotionDataInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return \DateTime
     */
    public function getStartDate(): \DateTime;

    /**
     * @return \DateTime
     */
    public function getEndDate(): \DateTime;

    /**
     * @return string
     */
    public function getVoucherCode(): string;

    /**
     * @return string
     */
    public function getServiceId(): string;

    /**
     * @param string $serviceId
     */
    public function setServiceId(string $serviceId);

    /**
     * @return bool
     */
    public function isValid();
}
