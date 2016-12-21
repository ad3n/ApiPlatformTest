<?php

namespace AppBundle\ActionLogger;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\Mapping\ClassMetadata;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class ActionLoggableSubscriber implements EventSubscriber
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param LoadClassMetadataEventArgs $eventArgs
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        /** @var ClassMetadata $classMetadata */
        $classMetadata = $eventArgs->getClassMetadata();
        if (null === $classMetadata->reflClass) {
            return;
        }

        if (!in_array(ActionLoggable::class, $classMetadata->reflClass->getTraitNames())) {
            return;
        }

        foreach (['createdBy', 'updatedBy'] as $field) {
            if (!$classMetadata->hasField($field)) {
                $classMetadata->mapField([
                    'fieldName' => $field,
                    'type' => 'string',
                    'nullable' => true,
                ]);
            }
        }
    }

    /**
     * @param LifecycleEventArgs $eventArgs
     */
    public function prePersist(LifecycleEventArgs $eventArgs)
    {
        /** @var ActionLoggable $entity */
        $entity = $eventArgs->getEntity();
        if (!$entity instanceof ActionLoggable) {
            return;
        }

        $this->updateActionLog($entity);
    }

    /**
     * @param PreUpdateEventArgs $eventArgs
     */
    public function preUpdate(PreUpdateEventArgs $eventArgs)
    {
        /** @var ActionLoggable $entity */
        $entity = $eventArgs->getEntity();
        if (!$entity instanceof ActionLoggable) {
            return;
        }

        $this->updateActionLog($entity);
    }

    /**
     * @param ActionLoggable $loggable
     */
    private function updateActionLog(ActionLoggable $loggable)
    {
        if (!$token = $this->tokenStorage->getToken()) {
            return;
        }

        if (!$loggable->getCreatedBy()) {
            $loggable->setCreatedBy($token->getUsername());
        }

        $loggable->setUpdatedBy($token->getUsername());
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [Events::loadClassMetadata, Events::prePersist, Events::preUpdate];
    }
}
