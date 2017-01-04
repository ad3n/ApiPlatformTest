<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource(collectionOperations={"get"={"method"="GET"}}, itemOperations={"get"={"method"="GET"}})
 *
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class AssetOwner
{
    /**
     * @var int
     *
     * @ApiProperty(identifier=true)
     */
    private $id;

    /**
     * @var string
     */
    private $owner;

    /**
     * @var string
     */
    private $ownerClass;

    /**
     * @var string
     */
    private $name;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
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
     * @return string
     */
    public function getOwnerClass(): string
    {
        return $this->ownerClass;
    }

    /**
     * @param string $ownerClass
     */
    public function setOwnerClass(string $ownerClass)
    {
        $this->ownerClass = $ownerClass;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }
}
