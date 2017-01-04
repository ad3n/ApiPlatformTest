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
     * @var Payload
     *
     * @ORM\Column(type="text")
     */
    private $payload;

    /**
     * @var Response
     *
     * @ORM\Column(type="text")
     */
    private $response;

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
     * @param PaymentMethodInterface $paymentMethod
     */
    public function setPaymentMethod(PaymentMethodInterface $paymentMethod)
    {
        $this->paymentMethod = $paymentMethod->getName();
    }

    /**
     * @return Payload|null
     */
    public function getPayload()
    {
        if (!$this->owner || !$this->payload) {
            return null;
        }

        $payload = new Payload();
        $payload->setOwner($this->owner);

        return $payload->unserialize($this->payload);
    }

    /**
     * @param Payload $payload
     */
    public function setPayload(Payload $payload)
    {
        $this->payload = $payload->serialize();
    }

    /**
     * @return Response
     */
    public function getResponse(): Response
    {
        if (!$this->owner || !$this->response) {
            return null;
        }
        $response = new Response();

        return $response->unserialize($this->owner, $this->response);
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
