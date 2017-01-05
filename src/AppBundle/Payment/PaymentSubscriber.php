<?php

namespace AppBundle\Payment;

use AppBundle\Transaction\TransactionInterface;
use AppBundle\Util\PaymentStatus;
use AppBundle\Util\TransactionStatus;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\ObjectManager;
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
     * @var ObjectManager
     */
    private $objectManager;

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
     * @param LifecycleEventArgs $eventArgs
     */
    public function postPersist(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();
        if ($entity instanceof PaymentInterface) {
            $this->objectManager = $eventArgs->getObjectManager();
            $this->updateTransactionStatus($entity);
        }
    }

    /**
     * @param LifecycleEventArgs $eventArgs
     */
    public function postUpdate(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();
        if ($entity instanceof PaymentInterface) {
            $this->objectManager = $eventArgs->getObjectManager();
            $this->updateTransactionStatus($entity);
        }
    }

    /**
     * @param PaymentInterface $payment
     */
    private function updateTransactionStatus(PaymentInterface $payment)
    {
        $payment->setPaymentFactory($this->paymentFactory);
        $this->paymentFactory->paymentRequest($payment->getPaymentMethod()->getName(), $payment->getPayload());
        $payment->setResponse($this->paymentFactory->getResponse());

        /** @var TransactionInterface $transaction */
        $transaction = $payment->getOwner();
        if (in_array($payment->getPaymentStatus(), array(PaymentStatus::SUCCESS, PaymentStatus::VERIFIED))) {
            $transaction->setTransactionStatus(TransactionStatus::PAYMENT_SUCCESS);

            $this->objectManager->persist($transaction);
            $this->objectManager->flush();
        }

        if (PaymentStatus::ERROR === $payment->getPaymentStatus()) {
            $transaction->setTransactionStatus(TransactionStatus::WAITING_FOR_PAYMENT);

            $this->objectManager->persist($transaction);
            $this->objectManager->flush();
        }
    }

    /**
     * @return array
     */
    public function getSubscribedEvents(): array
    {
        return [Events::postLoad, Events::postPersist, Events::postUpdate];
    }
}
