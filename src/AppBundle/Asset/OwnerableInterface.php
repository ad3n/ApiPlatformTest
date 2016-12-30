<?php

namespace AppBundle\Asset;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface OwnerableInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @param AssetInterface $resource
     */
    public function addFile(AssetInterface $resource);

    /**
     * @return AssetInterface[]
     */
    public function getFiles(): array;

    /**
     * @param array $files
     */
    public function setFiles(array $files);
}
