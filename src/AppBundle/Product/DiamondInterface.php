<?php

namespace AppBundle\Product;

use AppBundle\Certificate\CertificateInterface;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface DiamondInterface extends ProductInterface
{
    /**
     * @return float
     */
    public function getCarat(): float;

    /**
     * @return float
     */
    public function getPrice(): float;

    /**
     * @return float
     */
    public function getDepth(): float;

    /**
     * @return float
     */
    public function getDiamondTable(): float;

    /**
     * @return string
     */
    public function getShape(): string;

    /**
     * @return string
     */
    public function getColor(): string;

    /**
     * @return string
     */
    public function getClarity(): string;

    /**
     * @return string
     */
    public function getFluorescence(): string;

    /**
     * @return string
     */
    public function getCut(): string;

    /**
     * @return string
     */
    public function getPolish(): string;

    /**
     * @return string
     */
    public function getSymmetry(): string;

    /**
     * @return CertificateInterface|null
     */
    public function getCertificate();
}
