<?php

namespace AppBundle\Asset;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class AssetUploader
{
    /**
     * @var string
     */
    private $uploadDir;

    /**
     * @param string $uploadDir
     */
    public function __construct(string $uploadDir)
    {
        $this->uploadDir = $uploadDir;
    }

    /**
     * @param UploadedFile $file
     *
     * @return File
     */
    public function upload(UploadedFile $file)
    {
        $fileName = sprintf('%s.%s', md5(uniqid()), $file->guessExtension());

        $file->move($this->uploadDir, $fileName);

        return new File(sprintf('%s/%s', $this->uploadDir, $fileName));
    }

    /**
     * @return string
     */
    public function getUploadDir(): string
    {
        return $this->uploadDir;
    }
}
