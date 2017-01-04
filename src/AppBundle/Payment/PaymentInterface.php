<?php

namespace AppBundle\Payment;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface PaymentInterface
{
    /**
     * @return \DateTime
     */
    public function getPaymentDate(): \DateTime;

    /**
     * @return OwnerableInterface
     */
    public function getOwner(): OwnerableInterface;

    /**
     * @param OwnerableInterface $transaction
     */
    public function setOwner(OwnerableInterface $transaction);

    /**
     * @return PaymentMethodInterface
     */
    public function getPaymentMethod(): PaymentMethodInterface;

    /**
     * @param string $paymentMethod
     */
    public function setPaymentMethod(string $paymentMethod);

    /**
     * @return Payload
     */
    public function getPayload(): Payload;

    /**
     * @param Payload $payload
     */
    public function setPayload(Payload $payload);

    /**
     * @return array
     */
    public function getMetadata(): array;

    /**
     * @param array $metadata
     */
    public function setMetadata(array $metadata);

    /**
     * @return Response
     */
    public function getResponse(): Response;

    /**
     * @param Response $response
     */
    public function setResponse(Response $response);

    /**
     * @return string
     */
    public function getPaymentStatus(): string;

    /**
     * @param PaymentFactory $paymentFactory
     */
    public function setPaymentFactory(PaymentFactory $paymentFactory);
}
