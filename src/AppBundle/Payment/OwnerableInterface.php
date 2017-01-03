<?php

namespace AppBundle\Payment;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface OwnerableInterface
{
    /**
     * @param PaymentInterface $payment
     */
    public function setPayment(PaymentInterface $payment);

    /**
     * @return PaymentInterface|null
     */
    public function getPayment();
}
