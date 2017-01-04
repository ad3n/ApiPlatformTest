<?php

namespace AppBundle\Price;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class PriceCalculatorSubscriber implements EventSubscriber
{
    /**
     * @var PriceFactory
     */
    private $priceFactory;

    /**
     * @param PriceFactory $priceFactory
     */
    public function __construct(PriceFactory $priceFactory)
    {
        $this->priceFactory = $priceFactory;
    }

    /**
     * @param LifecycleEventArgs $eventArgs
     */
    public function postPersist(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();
        if ($entity instanceof PricableInterface) {
            $this->updatePrice($entity);
        }
    }

    /**
     * @param LifecycleEventArgs $eventArgs
     */
    public function postUpdate(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();
        if ($entity instanceof PricableInterface) {
            $this->updatePrice($entity);
        }
    }

    /**
     * @param PricableInterface $pricable
     */
    private function updatePrice(PricableInterface $pricable)
    {
        $this->priceFactory->calculate($pricable);
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [Events::postPersist, Events::postUpdate];
    }
}
