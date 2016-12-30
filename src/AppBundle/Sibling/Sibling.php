<?php

namespace AppBundle\Sibling;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
final class Sibling implements SiblingInterface
{
    /**
     * @var array
     */
    private $siblings;

    /**
     * @var int
     */
    private $siblingTo;

    /**
     * @param SiblingInterface $sibling
     */
    public function addSibling(SiblingInterface $sibling)
    {
        $this->siblings[sprintf('%s#%s', get_class($sibling), $sibling->getSiblingTo())] = $sibling;
    }

    /**
     * @param int $siblingTo
     */
    public function setSiblingTo(int $siblingTo)
    {
        $this->siblingTo = $siblingTo;
    }

    /**
     * @return int
     */
    public function getSiblingTo(): int
    {
        return $this->siblingTo;
    }

    /**
     * @return string
     */
    public function serialize(): string
    {
        $serial = '';
        /** @var SiblingInterface $sibling */
        foreach ($this->siblings as $sibling) {
            if ('' === $serial) {
                $serial = $sibling->getSiblingTo();
            } else {
                $serial = sprintf('%s#%s', $serial, $sibling->getSiblingTo());
            }
        }

        return $serial;
    }

    /**
     * @param string $string
     *
     * @return SiblingInterface
     */
    public function unserialize(string $string): SiblingInterface
    {
        $splits = explode('#', $string);
        foreach ($splits as $split) {
            $sibling = new self();
            $sibling->setSiblingTo($split);

            $this->addSibling($sibling);
        }

        return $this;
    }
}
