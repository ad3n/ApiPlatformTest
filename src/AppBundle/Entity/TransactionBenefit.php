<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use AppBundle\ActionLogger\ActionLoggable;
use AppBundle\Product\ProductInterface;
use AppBundle\Promotion\ItemInterface;
use AppBundle\Promotion\PromotableInterface;
use AppBundle\Promotion\PromotionBenefitInterface;
use AppBundle\Promotion\ItemRepositoryInterface;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;

/**
 * @ORM\Entity()
 * @ORM\Table(name="transaction_benefits")
 *
 * @ApiResource()
 *
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class TransactionBenefit implements PromotionBenefitInterface
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
     * @var PromotableInterface
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Transaction")
     * @ORM\JoinColumn(name="transaction_id", referencedColumnName="id")
     */
    private $owner;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $benefitItems;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $discountValue;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $discountPercentage;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $cashback;

    /**
     * @var ProductInterface
     */
    private $product;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $voucher;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $point;

    /**
     * @var ItemInterface[]
     */
    private $items;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return PromotableInterface
     */
    public function getOwner(): PromotableInterface
    {
        return $this->owner;
    }

    /**
     * @param PromotableInterface $owner
     */
    public function setOwner(PromotableInterface $owner)
    {
        $this->owner = $owner;
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

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
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
        $this->items[] = $item;
    }

    /**
     * @return float
     */
    public function getDiscountValue(): float
    {
        return $this->discountValue;
    }

    /**
     * @param float $discountValue
     */
    public function setDiscountValue(float $discountValue)
    {
        $this->discountValue = $discountValue;
    }

    /**
     * @return float
     */
    public function getDiscountPercentage(): float
    {
        return $this->discountPercentage;
    }

    /**
     * @param float $discountPercentage
     */
    public function setDiscountPercentage(float $discountPercentage)
    {
        $this->discountPercentage = $discountPercentage;
    }

    /**
     * @return float
     */
    public function getCashback(): float
    {
        return $this->cashback;
    }

    /**
     * @param float $cashback
     */
    public function setCashback(float $cashback)
    {
        $this->cashback = $cashback;
    }

    /**
     * @return ProductInterface
     */
    public function getProduct(): ProductInterface
    {
        return $this->product;
    }

    /**
     * @param ProductInterface $product
     */
    public function setProduct(ProductInterface $product)
    {
        $this->product = $product;
    }

    /**
     * @return string
     */
    public function getVoucher(): string
    {
        return $this->voucher;
    }

    /**
     * @param string $voucher
     */
    public function setVoucher(string $voucher)
    {
        $this->voucher = $voucher;
    }

    /**
     * @return int
     */
    public function getPoint(): int
    {
        return $this->point;
    }

    /**
     * @param int $point
     */
    public function setPoint(int $point)
    {
        $this->point = $point;
    }

    public function serializeItem()
    {
        $benefitItems = [];
        foreach ($this->items as $item) {
            $benefitItems[] = $item->getId();
        }

        $this->benefitItems = serialize($benefitItems);
    }

    /**
     * @param ItemRepositoryInterface $itemRepository
     */
    public function unserializeItem(ItemRepositoryInterface $itemRepository)
    {
        $benefitItems = unserialize($this->benefitItems);
        foreach ($benefitItems as $itemId) {
            if ($item = $itemRepository->find($itemId)) {
                $this->addItem($item);
            }
        }
    }
}
