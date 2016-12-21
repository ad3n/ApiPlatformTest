<?php

namespace AppBundle\Asset;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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

    /**
     * @param File $fileLocation
     */
    public function setFile(File $fileLocation);

    /**
     * @return File
     */
    public function getFile(): File;

    /**
     * @param UploadedFile $uploadedFile
     */
    public function setUploadedFile(UploadedFile $uploadedFile);

    /**
     * @return UploadedFile
     */
    public function getUploadedFile(): UploadedFile;
}
