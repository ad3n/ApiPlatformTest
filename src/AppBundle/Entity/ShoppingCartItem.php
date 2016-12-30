<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use AppBundle\ShoppingCart\ItemInterface;
use AppBundle\ShoppingCart\ItemRepositoryInterface;
use AppBundle\ShoppingCart\ShoppingCartInterface;
use AppBundle\ShoppingCart\ShoppingCartItemInterface;
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
class ShoppingCartItem implements ShoppingCartItemInterface
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
     * @var ShoppingCartInterface
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ShoppingCart")
     * @ORM\JoinColumn(name="shoppingcart_id", referencedColumnName="id")
     */
    private $owner;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $itemId;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $itemSource;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $metadata;

    /**
     * @var ItemInterface
     */
    private $item;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param ShoppingCartInterface $owner
     */
    public function setOwner(ShoppingCartInterface $owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return ShoppingCartInterface
     */
    public function getOwner(): ShoppingCartInterface
    {
        return $this->owner;
    }

    /**
     * @param ItemInterface $item
     */
    public function setItem(ItemInterface $item)
    {
        $this->item = $item;
        $this->itemId = $item->getId();
        $this->itemSource = get_class($item);
    }

    /**
     * @return ItemInterface
     */
    public function getItem(): ItemInterface
    {
        return $this->item;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        // TODO: Implement getQuantity() method.
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function addMetadata(string $key, string $value)
    {
        // TODO: Implement addMetadata() method.
    }

    /**
     * @param array $metadata
     */
    public function setMetadata(array $metadata)
    {
        // TODO: Implement setMetadata() method.
    }

    /**
     * @return array
     */
    public function getMetadata(): array
    {
        // TODO: Implement getMetadata() method.
    }

    public function serializeItem()
    {
    }

    /**
     * @param ItemRepositoryInterface $itemRepository
     */
    public function unserializeItem(ItemRepositoryInterface $itemRepository)
    {
    }
}
