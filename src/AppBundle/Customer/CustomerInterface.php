<?php

namespace AppBundle\Customer;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface CustomerInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getIdentityNumber(): string;

    /**
     * @return string
     */
    public function getIdentityType(): string;

    /**
     * @return string
     */
    public function getFirstName(): string;

    /**
     * @return string
     */
    public function getLastName(): string;

    /**
     * @return string
     */
    public function getFullName(): string;

    /**
     * @return string
     */
    public function getGender(): string;

    /**
     * @return string
     */
    public function getMaritalStatus(): string;

    /**
     * @return \DateTime
     */
    public function getBirthDate(): \DateTime;

    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @return string
     */
    public function getPhoneNumber(): string;

    /**
     * @return string
     */
    public function getHandPhoneNumber(): string;

    /**
     * @return \DateTime
     */
    public function getJoinDate(): \DateTime;

    /**
     * @return bool
     */
    public function isActive(): bool;
}
