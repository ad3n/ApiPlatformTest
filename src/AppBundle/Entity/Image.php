<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use AppBundle\ActionLogger\ActionLoggable;
use AppBundle\Asset\ResourceInterface;
use AppBundle\Asset\ResourceOwner;
use AppBundle\Asset\ResourceOwnerInterface;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;

/**
 * @ApiResource()
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
     * @return ResourceOwnerInterface
     */
    public function getOwner(): ResourceOwnerInterface
    {
        $resourceOwner = new ResourceOwner();
        if ($this->owner) {
            $resourceOwner->unserialize($this->owner);
        }

        return $resourceOwner;
    }

    /**
     * @param ResourceOwnerInterface $owner
     */
    public function setOwner(ResourceOwnerInterface $owner)
    {
        $this->owner = $owner->serialize();
    }

    /**
     * @return string
     */
    public function getFileLocation(): string
    {
        return $this->fileLocation;
    }

    /**
     * @param string $fileLocation
     */
    public function setFileLocation(string $fileLocation)
    {
        $this->fileLocation = $fileLocation;
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
