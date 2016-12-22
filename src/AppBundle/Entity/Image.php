<?php

namespace AppBundle\Entity;

use AppBundle\ActionLogger\ActionLoggable;
use AppBundle\Asset\ResourceInterface;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity()
 * @ORM\Table(name="images")
 *
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class Image implements ResourceInterface
{
    use Timestampable;
    use ActionLoggable;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $group;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $owner;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $sourceId;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $fileLocation;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $isPinned;

    /**
     * @var File
     */
    private $file;

    /**
     * @var UploadedFile
     */
    private $uploadedFile;

    public function __construct()
    {
        $this->isPinned = false;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getGroup(): string
    {
        return $this->group;
    }

    /**
     * @param string $group
     */
    public function setGroup(string $group)
    {
        $this->group = $group;
    }

    /**
     * @return string
     */
    public function getOwner(): string
    {
        return $this->owner;
    }

    /**
     * @param string $owner
     */
    public function setOwner(string $owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return int
     */
    public function getSourceId(): int
    {
        return $this->sourceId;
    }

    /**
     * @param int $sourceId
     */
    public function setSourceId(int $sourceId)
    {
        $this->sourceId = $sourceId;
    }

    /**
     * @return string
     */
    public function getFileLocation(): string
    {
        return $this->fileLocation;
    }

    /**
     * @return File
     */
    public function getFile(): File
    {
        return $this->file;
    }

    /**
     * @param File $file
     */
    public function setFile(File $file)
    {
        $this->file = $file;
        $this->fileLocation = $file->getFilename();
    }

    /**
     * @return UploadedFile
     */
    public function getUploadedFile(): UploadedFile
    {
        return $this->uploadedFile;
    }

    /**
     * @param UploadedFile $file
     */
    public function setUploadedFile(UploadedFile $file)
    {
        $this->uploadedFile = $file;
    }

    /**
     * @return bool
     */
    public function isPinned(): bool
    {
        return $this->isPinned;
    }

    /**
     * @param bool $isPinned
     */
    public function setPinned(bool $isPinned)
    {
        $this->isPinned = $isPinned;
    }
}
