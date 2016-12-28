<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use AppBundle\ActionLogger\ActionLoggable;
use AppBundle\Promotion\PromotionDataInterface;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;

/**
 * @ORM\Entity()
 * @ORM\Table(name="promotions")
 *
 * @ApiResource()
 *
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class Promotion implements PromotionDataInterface
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
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $endDate;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $voucherCode;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $serviceId;

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
    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     */
    public function setStartDate(\DateTime $startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime $endDate
     */
    public function setEndDate(\DateTime $endDate)
    {
        $this->endDate = $endDate;
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
     * @return string
     */
    public function getServiceId(): string
    {
        return $this->serviceId;
    }

    /**
     * @param string $serviceId
     */
    public function setServiceId(string $serviceId)
    {
        $this->serviceId = $serviceId;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        $now = new \DateTime();

        if ($now >= $this->startDate && $now <= $this->endDate) {
            return true;
        }

        return false;
    }
}
