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
     * @param string $owner
     */
    public function setOwner(string $owner);

    /**
     * @return string
     */
    public function getOwner(): string;

    /**
     * @param int $sourceId
     */
    public function setSourceId(int $sourceId);

    /**
     * @return int
     */
    public function getSourceId(): int;

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

    /**
     * @return bool
     */
    public function isPinned(): bool;
}
