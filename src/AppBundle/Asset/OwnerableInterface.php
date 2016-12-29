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
     * @param ResourceInterface $resource
     */
    public function addFile(ResourceInterface $resource);

    /**
     * @return ResourceInterface[]
     */
    public function getFiles(): array;

    /**
     * @param array $files
     */
    public function setFiles(array $files);
}
