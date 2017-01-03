<?php

namespace AppBundle\Payment;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class Response
{
    /**
     * @var Payload
     */
    private $payload;

    /**
     * @var string
     */
    private $url;

    /**
     * @var bool
     */
    private $status;

    /**
     * @var string
     */
    private $message;

    /**
     * @var array
     */
    private $metadata;

    /**
     * @var string
     */
    private $paymentType;

    /**
     * @return Payload
     */
    public function getPayload(): Payload
    {
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
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    /**
     * @return array
     */
    public function getMetadata(): array
    {
        return $this->metadata;
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
     * @param string $key
     * @param $value
     */
    public function addMetadata(string $key, $value)
    {
        $this->metadata[$key] = $value;
    }

    /**
     * @return string
     */
    public function getPaymentType(): string
    {
        return $this->paymentType;
    }

    /**
     * @param string $paymentType
     */
    public function setPaymentType(string $paymentType)
    {
        $this->paymentType = $paymentType;
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return serialize(sprintf('%s#%s#%s#%s#%s#%s',
            $this->payload->serialize(),
            $this->paymentType,
            $this->url,
            $this->message,
            $this->metadata,
            $this->status
        ));
    }

    /**
     * @param OwnerableInterface $owner
     * @param string             $response
     *
     * @return Response
     */
    public function unserialize(OwnerableInterface $owner, string $response): Response
    {
        $split = explode('#', unserialize($response));
        if (6 !== count($split)) {
            throw new \InvalidArgumentException(sprintf('%s is not valid response string', $response));
        }

        $payload = new Payload();
        $payload->setOwner($owner);
        $this->payload = $payload->unserialize($split[0]);
        $this->paymentType = $split[1];
        $this->url = $split[2];
        $this->message = $split[3];
        $this->metadata = $split[4];
        $this->status = $split[5];
    }
}
