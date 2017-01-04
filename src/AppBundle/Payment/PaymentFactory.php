<?php

namespace AppBundle\Payment;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class PaymentFactory
{
    /**
     * @var array
     */
    private $paymentMethods;

    /**
     * @var Response
     */
    private $response;

    /**
     * @param PaymentMethodInterface $paymentMethod
     */
    public function addPaymentMethod(PaymentMethodInterface $paymentMethod)
    {
        $this->paymentMethods[$paymentMethod->getName()] = $paymentMethod;
    }

    /**
     * @param string $paymentMethod
     *
     * @return PaymentMethodInterface
     */
    public function getPaymentMethod(string $paymentMethod): PaymentMethodInterface
    {
        if (!array_key_exists($paymentMethod, $this->paymentMethods)) {
            throw new \InvalidArgumentException(sprintf('Payment method %s not found', $paymentMethod));
        }

        return $this->paymentMethods[$paymentMethod];
    }

    /**
     * @param string  $paymentMethod
     * @param Payload $payload
     */
    public function paymentRequest(string $paymentMethod, Payload $payload)
    {
        if (!in_array($paymentMethod, array_keys($this->paymentMethods))) {
            throw new \InvalidArgumentException(sprintf('Payment method %s is not valid', $paymentMethod));
        }

        /** @var PaymentMethodInterface $method */
        $method = $this->paymentMethods[$paymentMethod];
        $this->response->setPaymentType($method->getPaymentType());
        $this->response = $method->requestPayment($payload);
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }
}
