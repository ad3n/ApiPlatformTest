<?php

namespace AppBundle\Asset;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface ResourceInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getGroup(): string;

    /**
     * @param ResourceOwnerInterface $owner
     */
    public function setOwner(ResourceOwnerInterface $owner);

    /**
     * @return ResourceOwnerInterface
     */
    public function getOwner(): ResourceOwnerInterface;

    /**
     * @return string
     */
    public function getFileLocation(): string;
}
