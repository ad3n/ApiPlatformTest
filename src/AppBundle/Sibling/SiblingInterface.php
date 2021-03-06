<?php

namespace AppBundle\Sibling;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface SiblingInterface
{
    /**
     * @param SiblingInterface $sibling
     */
    public function addSibling(SiblingInterface $sibling);

    /**
     * @return int
     */
    public function getSiblingTo(): int;

    /**
     * @return string
     */
    public function serialize(): string;

    /**
     * @param string $string
     *
     * @return SiblingInterface
     */
    public function unserialize(string $string): SiblingInterface;
}
