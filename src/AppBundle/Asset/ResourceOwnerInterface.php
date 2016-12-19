<?php

namespace AppBundle\Asset;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface ResourceOwnerInterface
{
    /**
     * @return int
     */
    public function getSourceId(): int;

    /**
     * @return string
     */
    public function getOwner(): string;

    /**
     * @return string
     */
    public function serialize(): string;

    /**
     * @param string $string
     *
     * @return ResourceOwnerInterface
     */
    public function unserialize(string $string): ResourceOwnerInterface;
}
