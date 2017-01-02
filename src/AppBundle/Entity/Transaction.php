<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use AppBundle\ActionLogger\ActionLoggable;
use AppBundle\Promotion\PromotableInterface;
use AppBundle\Promotion\PromotionBenefitInterface;
use AppBundle\ShoppingCart\ShoppingCartItemInterface;
use AppBundle\ShoppingCart\ShoppingCartInterface;
use AppBundle\Transaction\OwnerableInterface;
use AppBundle\Transaction\TransactionInterface;
use AppBundle\Util\TransactionStatus;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity()
 * @ORM\Table(name="transactions")
 *
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read"}}
 * })
 *
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class Transaction implements TransactionInterface, PromotableInterface
{
    use Timestampable;
    use ActionLoggable;

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
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     *
     * @Groups({"read"})
     */
    private $transactionDate;

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
     * @var ShoppingCartInterface
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ShoppingCart")
     * @ORM\JoinColumn(name="shoppingcart_id", referencedColumnName="id")
     *
     * @Groups({"read"})
     */
    private $shoppingCart;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     *
     * @Groups({"read"})
     */
    private $voucherCode;

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
     * @var float
     *
     * @ORM\Column(type="float")
     *
     * @Groups({"read"})
     */
    private $deliveryFee;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     *
     * @Groups({"read"})
     */
    private $discount;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     *
     * @Groups({"read"})
     */
    private $transactionStatus;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @Groups({"read"})
     */
    private $completedAt;

    /**
     * @var ShoppingCartItemInterface[]
     */
    private $items;

    /**
     * @var PromotionBenefitInterface[]
     */
    private $benefits;

    public function __construct()
    {
        $this->totalAmount = 0;
        $this->subTotal = 0;
        $this->tax = 0;
        $this->surchargeFee = 0;
        $this->deliveryFee = 0;
        $this->discount = 0;
        $this->transactionStatus = TransactionStatus::PENDING;
    }

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
    public function getTransactionDate(): \DateTime
    {
        return $this->transactionDate;
    }

    /**
     * @param \DateTime $transactionDate
     */
    public function setTransactionDate(\DateTime $transactionDate)
    {
        $this->transactionDate = $transactionDate;
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
     * @return ShoppingCartInterface
     */
    public function getShoppingCart(): ShoppingCartInterface
    {
        return $this->shoppingCart;
    }

    /**
     * @param ShoppingCartInterface $shoppingCart
     */
    public function setShoppingCart(ShoppingCartInterface $shoppingCart)
    {
        $this->shoppingCart = $shoppingCart;
    }

    /**
     * @return PromotionBenefitInterface[]
     */
    public function getBenefits(): array
    {
        return $this->benefits;
    }

    /**
     * @param PromotionBenefitInterface[] $benefits
     */
    public function setBenefits(array $benefits)
    {
        foreach ($benefits as $promotionBenefit) {
            $this->addItem($promotionBenefit);
        }
    }

    /**
     * @param PromotionBenefitInterface $promoBenefit
     */
    public function addBenefit(PromotionBenefitInterface $promoBenefit)
    {
        $this->benefits[] = $promoBenefit;
    }

    /**
     * @return string
     */
    public function getVoucherCode(): string
    {
        return $this->voucherCode;
    }

    /**
     * @param string $voucherCode
     */
    public function setVoucherCode(string $voucherCode)
    {
        $this->voucherCode = $voucherCode;
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
     * @return float
     */
    public function getDeliveryFee(): float
    {
        return $this->deliveryFee;
    }

    /**
     * @param float $deliveryFee
     */
    public function setDeliveryFee(float $deliveryFee)
    {
        $this->deliveryFee = $deliveryFee;
    }

    /**
     * @return float
     */
    public function getDiscount(): float
    {
        return $this->discount;
    }

    /**
     * @param float $discount
     */
    public function setDiscount(float $discount)
    {
        $this->discount = $discount;
    }

    /**
     * @return string
     */
    public function getTransactionStatus(): string
    {
        return $this->transactionStatus;
    }

    /**
     * @param string $transactionStatus
     */
    public function setTransactionStatus(string $transactionStatus)
    {
        if (!in_array($transactionStatus, [
            TransactionStatus::CANCEL,
            TransactionStatus::PENDING,
            TransactionStatus::WAITING_FOR_PAYMENT,
            TransactionStatus::ORDER_SUPPLIER,
            TransactionStatus::DELIVERING,
            TransactionStatus::COMPLETE,
        ])) {
            throw new \InvalidArgumentException(sprintf('%s is not valid transaction status', $transactionStatus));
        }

        $this->transactionStatus = $transactionStatus;
    }

    /**
     * @return \DateTime|null
     */
    public function getCompletedAt()
    {
        return $this->completedAt;
    }

    /**
     * @param \DateTime $completedAt
     */
    public function setCompletedAt(\DateTime $completedAt)
    {
        $this->completedAt = $completedAt;
    }

    /**
     * @return ShoppingCartItemInterface[]
     */
    public function getItems(): array
    {
        return $this->items;
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
