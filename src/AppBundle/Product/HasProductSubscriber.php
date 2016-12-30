<?php

namespace AppBundle\Product;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class HasProductSubscriber implements EventSubscriber
{
    /**
     * @var ProductFactory
     */
    private $productFactory;

    /**
     * @param ProductFactory $productFactory
     */
    public function __construct(ProductFactory $productFactory)
    {
        $this->productFactory = $productFactory;
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof HasProductInterface) {
            return;
        }

        $this->productFactory->setManager($args->getObjectManager());
        $product = $this->productFactory->getProduct($entity->getProductId(), $entity->getProductSource());
        if ($product instanceof ProductInterface) {
            $entity->setProduct($product);
        }
    }

    /**
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [Events::postLoad];
    }
}
