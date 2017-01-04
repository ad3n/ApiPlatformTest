<?php

namespace AppBundle\Payment;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class PaymentSubscriber implements EventSubscriber
{
    /**
     * @var PaymentFactory
     */
    private $paymentFactory;

    /**
     * @param PaymentFactory $paymentFactory
     */
    public function __construct(PaymentFactory $paymentFactory)
    {
        $this->paymentFactory = $paymentFactory;
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof PaymentInterface) {
            return;
        }

        $entity->setPaymentFactory($this->paymentFactory);
    }

    /**
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [Events::postLoad];
    }
}
