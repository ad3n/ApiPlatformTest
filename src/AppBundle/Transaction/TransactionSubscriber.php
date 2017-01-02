<?php

namespace AppBundle\Transaction;

use AppBundle\ShoppingCart\ShoppingCartInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class TransactionSubscriber implements EventSubscriber
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof TransactionInterface) {
            return;
        }
        $this->objectManager = $args->getObjectManager();

        $shoppingCart = $entity->getShoppingCart();
//        $this->updateShoppingCart($shoppingCart);
//        $this->updateTransaction($entity, $shoppingCart);
    }

    /**
     * @param PreUpdateEventArgs $args
     */
    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof TransactionInterface) {
            return;
        }
        $this->objectManager = $args->getObjectManager();

        $shoppingCart = $entity->getShoppingCart();
        $this->updateShoppingCart($shoppingCart);
        $this->updateTransaction($entity, $shoppingCart);
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof TransactionInterface) {
            return;
        }

        $entity->setItems($entity->getShoppingCart()->getItems());
    }

    /**
     * @param TransactionInterface $transaction
     * @param ShoppingCartInterface $shoppingCart
     */
    private function updateTransaction(TransactionInterface $transaction, ShoppingCartInterface $shoppingCart)
    {
        $transaction->setTotalAmount($shoppingCart->getTotalAmount());
        $transaction->setSubTotal($shoppingCart->getSubTotal());
        $transaction->setTax($shoppingCart->getTax());
    }

    /**
     * @param ShoppingCartInterface $shoppingCart
     */
    private function updateShoppingCart(ShoppingCartInterface $shoppingCart)
    {
        $shoppingCart->setProcessed(true);
        $shoppingCart->setProcessingDate(new \DateTime());
        $this->objectManager->persist($shoppingCart);
        $this->objectManager->flush();
    }

    /**
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [Events::postLoad, Events::prePersist, Events::preUpdate];
    }
}
