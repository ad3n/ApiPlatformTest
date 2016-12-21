<?php

namespace AppBundle\Entity;

use AppBundle\ActionLogger\ActionLoggable;
use AppBundle\Asset\OwnerableInterface;
use AppBundle\Model\CertificateInterface;
use AppBundle\Model\JewelryInterface;
use AppBundle\Model\ProductInterface;
use AppBundle\Model\SupplierInterface;
use AppBundle\Price\PricableInterface;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;

/**
 * @ORM\Entity()
 * @ORM\Table(name="diamonds")
 *
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class Diamond implements JewelryInterface, ProductInterface, OwnerableInterface, PricableInterface
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
     * @var SupplierInterface
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Supplier")
     * @ORM\JoinColumn(name="supplier_id", referencedColumnName="id")
     */
    private $supplier;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $supplierCode;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $sku;

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
    private $alternateName;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $carat;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $depth;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $table;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $shape;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $color;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $clarity;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $fluorescence;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $cut;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $polish;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $symmetry;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $certificate;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $tax;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $priceServiceId;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $isShow;

    public function __construct()
    {
        $this->isShow = true;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return SupplierInterface
     */
    public function getSupplier(): SupplierInterface
    {
        return $this->supplier;
    }

    /**
     * @param SupplierInterface $supplier
     */
    public function setSupplier(SupplierInterface $supplier)
    {
        $this->supplier = $supplier;
    }

    /**
     * @return string
     */
    public function getSupplierCode(): string
    {
        return $this->supplierCode;
    }

    /**
     * @param string $supplierCode
     */
    public function setSupplierCode(string $supplierCode)
    {
        $this->supplierCode = $supplierCode;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     */
    public function setSku(string $sku)
    {
        $this->sku = $sku;
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
    public function getAlternateName(): string
    {
        return $this->alternateName;
    }

    /**
     * @param string $alternateName
     */
    public function setAlternateName(string $alternateName)
    {
        $this->alternateName = $alternateName;
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
     * @return float
     */
    public function getCarat(): float
    {
        return $this->carat;
    }

    /**
     * @param float $carat
     */
    public function setCarat(float $carat)
    {
        $this->carat = $carat;
    }

    /**
     * @return float
     */
    public function getDepth(): float
    {
        return $this->depth;
    }

    /**
     * @param float $depth
     */
    public function setDepth(float $depth)
    {
        $this->depth = $depth;
    }

    /**
     * @return float
     */
    public function getTable(): float
    {
        return $this->table;
    }

    /**
     * @param float $table
     */
    public function setTable(float $table)
    {
        $this->table = $table;
    }

    /**
     * @return string
     */
    public function getShape(): string
    {
        return $this->shape;
    }

    /**
     * @param string $shape
     */
    public function setShape(string $shape)
    {
        $this->shape = $shape;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor(string $color)
    {
        $this->color = $color;
    }

    /**
     * @return string
     */
    public function getClarity(): string
    {
        return $this->clarity;
    }

    /**
     * @param string $clarity
     */
    public function setClarity(string $clarity)
    {
        $this->clarity = $clarity;
    }

    /**
     * @return string
     */
    public function getFluorescence(): string
    {
        return $this->fluorescence;
    }

    /**
     * @param string $fluorescence
     */
    public function setFluorescence(string $fluorescence)
    {
        $this->fluorescence = $fluorescence;
    }

    /**
     * @return string
     */
    public function getCut(): string
    {
        return $this->cut;
    }

    /**
     * @param string $cut
     */
    public function setCut(string $cut)
    {
        $this->cut = $cut;
    }

    /**
     * @return string
     */
    public function getPolish(): string
    {
        return $this->polish;
    }

    /**
     * @param string $polish
     */
    public function setPolish(string $polish)
    {
        $this->polish = $polish;
    }

    /**
     * @return string
     */
    public function getSymmetry(): string
    {
        return $this->symmetry;
    }

    /**
     * @param string $symmetry
     */
    public function setSymmetry(string $symmetry)
    {
        $this->symmetry = $symmetry;
    }

    /**
     * @return CertificateInterface
     */
    public function getCertificate(): CertificateInterface
    {
        $certificate = new Certificate();
        $certificate->unserialize($this->certificate);

        return $certificate;
    }

    /**
     * @param CertificateInterface $certificate
     */
    public function setCertificate(CertificateInterface $certificate)
    {
        $this->certificate = $certificate->serialize();
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price)
    {
        $this->price = $price;
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
     * @return string
     */
    public function getPriceCalculatorServiceId(): string
    {
        return $this->priceServiceId;
    }

    /**
     * @param string $serviceId
     */
    public function setPriceCalculatorServiceId(string $serviceId)
    {
        $this->priceServiceId = $serviceId;
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
     * @return bool
     */
    public function isShow(): bool
    {
        return $this->isShow;
    }

    /**
     * @param bool $isShow
     */
    public function setShow(bool $isShow)
    {
        $this->isShow = $isShow;
    }

    /**
     * @return string
     */
    public function getOwnerId(): string
    {
        return __CLASS__;
    }
}
