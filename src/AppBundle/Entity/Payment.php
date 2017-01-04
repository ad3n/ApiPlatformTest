<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use AppBundle\ActionLogger\ActionLoggable;
use AppBundle\Payment\OwnerableInterface;
use AppBundle\Payment\Payload;
use AppBundle\Payment\PaymentFactory;
use AppBundle\Payment\PaymentInterface;
use AppBundle\Payment\PaymentMethodInterface;
use AppBundle\Payment\Response;
use AppBundle\Util\PaymentStatus;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;

/**
 * @ORM\Entity()
 * @ORM\Table(name="payments")
 *
 * @ApiResource()
 *
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class Payment implements PaymentInterface
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
    private $paymentDate;

    /**
     * @var OwnerableInterface
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
    private $paymentMethod;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $metadata;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $responseData;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $paymentStatus;

    /**
     * @var PaymentFactory
     */
    private $paymentFactory;

    /**
     * @var Payload
     */
    private $payload;

    /**
     * @var Response
     */
    private $response;

    public function __construct()
    {
        $this->payload = new Payload();
        $this->response = new Response();
        $this->paymentStatus = PaymentStatus::PENDING;
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
    public function getPaymentDate(): \DateTime
    {
        return $this->paymentDate;
    }

    /**
     * @param \DateTime $paymentDate
     */
    public function setPaymentDate(\DateTime $paymentDate)
    {
        $this->paymentDate = $paymentDate;
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
     * @return PaymentMethodInterface
     */
    public function getPaymentMethod(): PaymentMethodInterface
    {
        return $this->paymentFactory->getPaymentMethod($this->paymentMethod);
    }

    /**
     * @param string $paymentMethod
     */
    public function setPaymentMethod(string $paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * @return Payload
     */
    public function getPayload(): Payload
    {
        if (!$this->owner || !$this->metadata) {
            return null;
        }

        $this->payload->setOwner($this->owner);
        $this->payload->unserialize($this->metadata);

        return $this->payload;
    }

    /**
     * @param Payload $payload
     */
    public function setPayload(Payload $payload)
    {
        $this->payload = $payload;
    }

    /**
     * @return array
     */
    public function getMetaData(): array
    {
        $payload = $this->getPayload();

        return $payload->getMetadata();
    }

    /**
     * @param array $metadata
     */
    public function setMetadata(array $metadata)
    {
        $this->payload->setMetadata($metadata);
        $this->metadata = $this->payload->serialize();
    }

    /**
     * @return string
     */
    public function getResponseData(): string
    {
        return $this->responseData;
    }

    /**
     * @param string $responseData
     */
    public function setResponseData(string $responseData)
    {
        $this->responseData = $responseData;
    }

    /**
     * @return Response
     */
    public function getResponse(): Response
    {
        if (!$this->owner || !$this->responseData) {
            return null;
        }

        $this->response->unserialize($this->owner, $this->responseData);

        return $this->response;
    }

    /**
     * @param Response $response
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
    }

    /**
     * @return string
     */
    public function getPaymentStatus(): string
    {
        return $this->paymentStatus;
    }

    /**
     * @param string $paymentStatus
     */
    public function setPaymentStatus(string $paymentStatus)
    {
        $this->paymentStatus = $paymentStatus;
    }

    /**
     * @param PaymentFactory $paymentFactory
     */
    public function setPaymentFactory(PaymentFactory $paymentFactory)
    {
        $this->paymentFactory = $paymentFactory;
    }
}
