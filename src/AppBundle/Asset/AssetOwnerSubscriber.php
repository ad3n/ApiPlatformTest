<?php

namespace AppBundle\Asset;

use AppBundle\Asset\DataProvider\AssetOwnerDataProvider;
use AppBundle\Entity\AssetOwner;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class AssetOwnerSubscriber implements EventSubscriber
{
    /**
     * @var AssetOwnerFactory
     */
    private $assetOwnerFactory;

    /**
     * @var AssetOwnerDataProvider
     */
    private $assetOwnerDataProvider;

    /**
     * @param AssetOwnerFactory      $assetOwnerFactory
     * @param AssetOwnerDataProvider $assetOwnerDataProvider
     */
    public function __construct(AssetOwnerFactory $assetOwnerFactory, AssetOwnerDataProvider $assetOwnerDataProvider)
    {
        $this->assetOwnerFactory = $assetOwnerFactory;
        $this->assetOwnerDataProvider = $assetOwnerDataProvider;
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof OwnerableInterface) {
            return;
        }

        /** @var AssetOwner $owner */
        $owner = $this->assetOwnerDataProvider->getOwnerByClass(get_class($entity));
        $this->assetOwnerFactory->setManager($args->getObjectManager());
        $entity->setFiles($this->assetOwnerFactory->findByOwner($owner->getOwnerClass(), $entity->getId()));
    }

    /**
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [Events::postLoad];
    }
}
