<?php

namespace AppBundle\Payment;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class Payload
{
    /**
     * @var OwnerableInterface
     */
    private $owner;

    /**
     * @var array
     */
    private $metadata = [];

    /**
     * @return OwnerableInterface
     */
    public function getOwner(): OwnerableInterface
    {
        return $this->owner;
    }

    /**
     * @param OwnerableInterface $owner
     */
    public function setOwner(OwnerableInterface $owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return array
     */
    public function getMetadata(): array
    {
        return $this->metadata;
    }

    /**
     * @param array $metadata
     */
    public function setMetadata(array $metadata)
    {
        foreach ($metadata as $key => $value) {
            $this->addMetadata($key, $value);
        }
    }

    /**
     * @param string $key
     * @param $value
     */
    public function addMetadata(string $key, $value)
    {
        $this->metadata[$key] = $value;
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return serialize($this->metadata);
    }

    /**
     * @param string $payload
     *
     * @return Payload
     */
    public function unserialize(string $payload): Payload
    {
        if (!$this->owner) {
            throw new \RuntimeException('call "setOwner" method before unserializing');
        }

        $this->metadata = unserialize($payload);

        return $this;
    }
}
