<?php

namespace AppBundle\Asset;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class AssetSubscriber implements EventSubscriber
{
    /**
     * @var AssetUploader
     */
    private $uploader;

    /**
     * @param AssetUploader $uploader
     */
    public function __construct(AssetUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof AssetInterface) {
            return;
        }

        $this->uploadFile($entity);
    }

    /**
     * @param PreUpdateEventArgs $args
     */
    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof AssetInterface) {
            return;
        }

        $this->uploadFile($entity);
    }

    /**
     * @param $entity
     */
    private function uploadFile(AssetInterface $entity)
    {
        $file = $entity->getUploadedFile();

        if (!$file instanceof UploadedFile) {
            return;
        }

        $entity->setFile($this->uploader->upload($file));
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        /** @var AssetInterface $entity */
        $entity = $args->getEntity();

        if (!$entity instanceof AssetInterface) {
            return;
        }

        $entity->setFile(new File(sprintf('%s/%s', $this->uploader->getUploadDir(), $entity->getFileName())));
    }

    /**
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [Events::postLoad, Events::prePersist, Events::preUpdate];
    }
}
