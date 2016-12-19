<?php

namespace AppBundle\Asset;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
final class ResourceOwner implements ResourceOwnerInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $sourceId;

    /**
     * @var string
     */
    private $owner;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $sourceId
     */
    public function setSourceId(int $sourceId)
    {
        $this->sourceId = $sourceId;
    }

    /**
     * @return int
     */
    public function getSourceId(): int
    {
        return $this->sourceId;
    }

    /**
     * @param string $databaseTable
     */
    public function setOwner(string $databaseTable)
    {
        $this->owner = $databaseTable;
    }

    /**
     * @return string
     */
    public function getOwner(): string
    {
        return $this->owner;
    }

    /**
     * @return string
     */
    public function serialize(): string
    {
        return sprintf('%s#%d', $this->owner, $this->sourceId);
    }

    /**
     * @param string $string
     *
     * @return ResourceOwnerInterface
     */
    public function unserialize(string $string): ResourceOwnerInterface
    {
        $split = explode('#', trim($string));

        if (2 === count($split)) {
            $this->setOwner($split[0]);
            $this->setSourceId($split[1]);
        }

        return $this;
    }
}
