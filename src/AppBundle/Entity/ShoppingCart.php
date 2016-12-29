<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use AppBundle\Customer\CustomerInterface;
use AppBundle\ShoppingCart\ItemInterface;
use AppBundle\ShoppingCart\OwnerableInterface;
use AppBundle\ShoppingCart\ShoppingCartInterface;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;

/**
 * @ORM\Entity()
 * @ORM\Table(name="shopping_carts")
 *
 * @ApiResource()
 *
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class ShoppingCart implements ShoppingCartInterface
{
    use Timestampable;

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
    private $uniqueId;

    /**
     * @var CustomerInterface
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Customer")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private $owner;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $totalAmount;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $isProcessed;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $processingDate;

    /**
     * @var ItemInterface[]
     */
    private $items;

    public function __construct()
    {
        $this->items = [];
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
    public function getUniqueId(): string
    {
        return $this->uniqueId;
    }

    /**
     * @param string $uniqueId
     */
    public function setUniqueId(string $uniqueId)
    {
        $this->uniqueId = $uniqueId;
    }

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
     * @return float
     */
    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }

    /**
     * @param float $totalAmount
     */
    public function setTotalAmount(float $totalAmount)
    {
        $this->totalAmount = $totalAmount;
    }

    /**
     * @return bool
     */
    public function isProcessed(): bool
    {
        return $this->isProcessed;
    }

    /**
     * @param bool $isProcessed
     */
    public function setProcessed(bool $isProcessed)
    {
        $this->isProcessed = $isProcessed;
    }

    /**
     * @return \DateTime
     */
    public function getProcessingDate(): \DateTime
    {
        return $this->processingDate;
    }

    /**
     * @param \DateTime $processingDate
     */
    public function setProcessingDate(\DateTime $processingDate)
    {
        $this->processingDate = $processingDate;
    }

    /**
     * @return ItemInterface[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param ItemInterface $item
     */
    public function addItem(ItemInterface $item)
    {
        $this->items[$item->getId()] = $item;
    }

    /**
     * @param ItemInterface $item
     *
     * @return ItemInterface[]
     */
    public function removeItem(ItemInterface $item): array
    {
        unset($this->items[$item->getId()]);

        return $this->items;
    }
}
