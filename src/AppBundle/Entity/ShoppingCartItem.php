<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use AppBundle\Product\HasProductInterface;
use AppBundle\Product\ProductInterface;
use AppBundle\ShoppingCart\ShoppingCartInterface;
use AppBundle\ShoppingCart\ShoppingCartItemInterface;
use AppBundle\Util\StringUtil;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity()
 * @ORM\Table(name="shoppingcart_items")
 *
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read"}},
 *     "filters"={"owner.search"}
 * })
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
     *
     * @Groups({"read"})
     */
    private $id;

    /**
     * @var ShoppingCartInterface
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ShoppingCart")
     * @ORM\JoinColumn(name="shoppingcart_id", referencedColumnName="id")
     *
     * @Groups({"read"})
     */
    private $owner;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     *
     * @Groups({"read"})
     */
    private $productId;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     *
     * @Groups({"read"})
     */
    private $productSource;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     *
     * @Groups({"read"})
     */
    private $quantity;

    /**
     * @var array
     *
     * @ORM\Column(type="array")
     *
     * @Groups({"read"})
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
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @param int $id
     */
    public function setProductId(int $id)
    {
        $this->productId = $id;
    }

    /**
     * @return string
     */
    public function getProductSource(): string
    {
        $reflection = new \ReflectionClass($this->productSource);

        return StringUtil::camelCaseToUnderScore($reflection->getShortName());
    }

    /**
     * @return string
     */
    public function getProductClass(): string
    {
        return $this->productSource;
    }

    /**
     * @param string $source
     */
    public function setProductSource(string $source)
    {
        $productClass = sprintf('AppBundle\Entity\%s', StringUtil::underScoreToCamelCase($source));
        $product = new $productClass();
        if (!$product instanceof ProductInterface) {
            throw new \InvalidArgumentException(sprintf('Product with type %s is not found', $source));
        }

        $this->product = $product;
        $this->productSource = get_class($product);
    }

    /**
     * @return ProductInterface|null
     */
    public function getProduct()
    {
        return $this->product;
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
     * @param mixed  $value
     */
    public function addMetadata(string $key, $value)
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
