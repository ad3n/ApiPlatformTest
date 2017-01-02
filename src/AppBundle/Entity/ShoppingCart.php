<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use AppBundle\ShoppingCart\ShoppingCartItemInterface;
use AppBundle\ShoppingCart\OwnerableInterface;
use AppBundle\ShoppingCart\ShoppingCartInterface;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity()
 * @ORM\Table(name="shoppingcarts")
 *
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read"}}
 * })
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
     *
     * @Groups({"read"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     *
     * @Groups({"read"})
     */
    private $uniqueId;

    /**
     * @var OwnerableInterface
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Customer")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     *
     * @Groups({"read"})
     */
    private $owner;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     *
     * @Groups({"read"})
     */
    private $totalAmount;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     *
     * @Groups({"read"})
     */
    private $subTotal;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     *
     * @Groups({"read"})
     */
    private $tax;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     *
     * @Groups({"read"})
     */
    private $surchargeFee;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     *
     * @Groups({"read"})
     */
    private $isProcessed;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @Groups({"read"})
     */
    private $processingDate;

    /**
     * @var ShoppingCartItemInterface[]
     */
    private $items;

    public function __construct()
    {
        $this->totalAmount = 0;
        $this->subTotal = 0;
        $this->surchargeFee = 0;
        $this->tax = 0;
        $this->isProcessed = false;
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
     * @return float
     */
    public function getSubTotal(): float
    {
        return $this->subTotal;
    }

    /**
     * @param float $subTotal
     */
    public function setSubTotal(float $subTotal)
    {
        $this->subTotal = $subTotal;
    }

    /**
     * @return float
     */
    public function getTax(): float
    {
        return $this->tax;
    }

    /**
     * @param float $tax
     */
    public function setTax(float $tax)
    {
        $this->tax = $tax;
    }

    /**
     * @return float
     */
    public function getSurchargeFee(): float
    {
        return $this->surchargeFee;
    }

    /**
     * @param float $surchargeFee
     */
    public function setSurchargeFee(float $surchargeFee)
    {
        $this->surchargeFee = $surchargeFee;
    }

    /**
     * @return bool
     */
    public function isProcessed(): bool
    {
        return $this->isProcessed ?: false;
    }

    /**
     * @param bool $isProcessed
     */
    public function setProcessed(bool $isProcessed)
    {
        $this->isProcessed = $isProcessed;
    }

    /**
     * @return \DateTime|null
     */
    public function getProcessingDate()
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
     * @return ShoppingCartItemInterface[]
     */
    public function getItems(): array
    {
        return $this->items ?: [];
    }

    /**
     * @param ShoppingCartItemInterface[] $items
     */
    public function setItems(array $items)
    {
        foreach ($items as $item) {
            $this->addItem($item);
        }
    }

    /**
     * @param ShoppingCartItemInterface $item
     */
    public function addItem(ShoppingCartItemInterface $item)
    {
        $this->items[] = $item;
    }
}
