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
     * @param PaymentMethodInterface $paymentMethod
     */
    public function setPaymentMethod(PaymentMethodInterface $paymentMethod);

    /**
     * @return Payload|null
     */
    public function getPayload();

    /**
     * @param Payload $payload
     */
    public function setPayload(Payload $payload);

    /**
     * @return Response|null
     */
    public function getResponse();

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
