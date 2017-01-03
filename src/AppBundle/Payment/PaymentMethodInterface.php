<?php

namespace AppBundle\Payment;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface PaymentMethodInterface
{
    /**
     * @param Payload $payload
     *
     * @return Response
     */
    public function requestPayment(Payload $payload);

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getPaymentType(): string;
}
