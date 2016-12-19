<?php

namespace AppBundle\Model;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface CertificateInterface
{
    /**
     * @return string
     */
    public function getCertNo(): string;

    /**
     * @return string
     */
    public function getCertLocation(): string;

    /**
     * @return string
     */
    public function getProvider(): string;

    /**
     * @return string
     */
    public function serialize(): string;

    /**
     * @param string $string
     *
     * @return CertificateInterface
     */
    public function unserialize(string $string): CertificateInterface;
}
