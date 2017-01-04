<?php

namespace AppBundle\Payment\Method;

use AppBundle\Payment\Payload;
use AppBundle\Payment\PaymentMethodInterface;
use AppBundle\Payment\Response;
use AppBundle\Util\PaymentStatus;
use AppBundle\Util\PaymentType;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class ManualPayment implements PaymentMethodInterface
{
    /**
     * @param Payload $payload
     *
     * @return Response
     */
    public function requestPayment(Payload $payload)
    {
        $response = new Response();
        $response->setPayload($payload);
        $response->setMessage('Manual Payment');
        $response->setStatus(PaymentStatus::PENDING);

        return $response;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'manual';
    }

    /**
     * @return string
     */
    public function getPaymentType(): string
    {
        return PaymentType::MANUAL;
    }
}
