<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use AppBundle\ActionLogger\ActionLoggable;
use AppBundle\Promotion\PromotableInterface;
use AppBundle\Promotion\PromotionBenefitInterface;
use AppBundle\ShoppingCart\ItemInterface;
use AppBundle\ShoppingCart\ShoppingCartInterface;
use AppBundle\Transaction\OwnerableInterface;
use AppBundle\Transaction\TransactionInterface;
use AppBundle\Util\TransactionStatus;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;

/**
 * @ORM\Entity()
 * @ORM\Table(name="transactions")
 *
 * @ApiResource()
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
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $transactionDate;

    /**
     * @var OwnerableInterface
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Customer")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private $owner;

    /**
     * @var ShoppingCartInterface
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ShoppingCart")
     * @ORM\JoinColumn(name="shoppingcart_id", referencedColumnName="id")
     */
    private $shoppingCart;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $voucherCode;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $totalAmount;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $subTotal;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $tax;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $surchargeFee;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $deliveryFee;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $transactionStatus;

    /**
     * @var ItemInterface[]
     */
    private $items;

    /**
     * @var PromotionBenefitInterface[]
     */
    private $benefits;

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
     * @return ItemInterface[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param ItemInterface[] $items
     */
    public function setItems(array $items)
    {
        foreach ($items as $item) {
            $this->addItem($item);
        }
    }

    /**
     * @param ItemInterface $item
     */
    public function addItem(ItemInterface $item)
    {
        $this->items[] = $item;
    }
}
