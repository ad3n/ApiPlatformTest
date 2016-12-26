<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use AppBundle\ActionLogger\ActionLoggable;
use AppBundle\Price\PricableInterface;
use AppBundle\Price\PriceLogInterface;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;

/**
 * @ORM\Entity()
 * @ORM\Table(name="price_logs")
 *
 * @ApiResource(collectionOperations={"get"={"method"="GET"}}, itemOperations={"get"={"method"="GET"}})
 *
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class PriceLog implements PriceLogInterface
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
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $dateTime;

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
    private $owner;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $stringify;

    /**
     * @var PricableInterface
     */
    private $source;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getDateTime(): \DateTime
    {
        return $this->dateTime;
    }

    /**
     * @param \DateTime $dateTime
     */
    public function setDateTime(\DateTime $dateTime)
    {
        $this->dateTime = $dateTime;
    }

    /**
     * @param PricableInterface $pricable
     */
    public function setSource(PricableInterface $pricable)
    {
        $this->source = $pricable;
        $this->sourceId = $pricable->getId();
        $this->owner = $pricable->getOwnerId();
        $this->price = $pricable->getPrice();

        $this->stringify = $this->serialize();
    }

    /**
     * @return PricableInterface
     */
    public function getSource(): PricableInterface
    {
        $this->unserialize();

        return $this->source;
    }

    /**
     * @return string
     */
    public function serialize(): string
    {
        return sprintf('%d#%s', $this->id, serialize($this->source));
    }

    /**
     * @param string $string
     *
     * @return PriceLogInterface
     */
    public function unserialize(string $string = null): PriceLogInterface
    {
        $split = $string ? explode('#', trim($string)) : explode('#', trim($this->source));

        if (2 === count($split)) {
            $this->id = $split[0];
            $this->source = unserialize($split[1]);
        }

        return $this;
    }
}
