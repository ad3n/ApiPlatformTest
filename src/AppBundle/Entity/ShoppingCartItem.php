<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use AppBundle\Product\HasProductInterface;
use AppBundle\Product\ProductInterface;
use AppBundle\ShoppingCart\ShoppingCartInterface;
use AppBundle\ShoppingCart\ShoppingCartItemInterface;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;

/**
 * @ORM\Entity()
 * @ORM\Table(name="shoppingcart_items")
 *
 * @ApiResource()
 *
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class ShoppingCartItem implements ShoppingCartItemInterface, HasProductInterface
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
    private $productId;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $productSource;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @var array
     *
     * @ORM\Column(type="array")
     */
    private $metadata;

    /**
     * @var ProductInterface
     */
    private $product;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return ShoppingCartInterface
     */
    public function getOwner(): ShoppingCartInterface
    {
        return $this->owner;
    }

    /**
     * @param ShoppingCartInterface $owner
     */
    public function setOwner(ShoppingCartInterface $owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return ProductInterface
     */
    public function getProduct(): ProductInterface
    {
        return $this->product;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @return string
     */
    public function getProductSource(): string
    {
        return $this->productSource;
    }

    /**
     * @param ProductInterface $product
     */
    public function setProduct(ProductInterface $product)
    {
        $this->product = $product;
        $this->productId = $product->getId();
        $this->productSource = get_class($product);
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function addMetadata(string $key, string $value)
    {
        $this->metadata[$key] = $value;
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
     * @return array
     */
    public function getMetadata(): array
    {
        return $this->metadata;
    }
}
