<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use AppBundle\ActionLogger\ActionLoggable;
use AppBundle\Certificate\CertificateInterface;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;

/**
 * @ORM\Entity()
 * @ORM\Table(name="certificates")
 *
 * @ApiResource()
 *
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class Certificate implements CertificateInterface
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
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $certNo;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $certLocation;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $provider;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string $certNo
     */
    public function setCertNo(string $certNo)
    {
        $this->certNo = $certNo;
    }

    /**
     * @return string
     */
    public function getCertNo(): string
    {
        return $this->certNo;
    }

    /**
     * @param string $certLocation
     */
    public function setCertLocation(string $certLocation)
    {
        $this->certLocation = $certLocation;
    }

    /**
     * @return string
     */
    public function getCertLocation(): string
    {
        return $this->certLocation;
    }

    /**
     * @param string $provider
     */
    public function setProvider(string $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @return string
     */
    public function getProvider(): string
    {
        return $this->provider;
    }
}
