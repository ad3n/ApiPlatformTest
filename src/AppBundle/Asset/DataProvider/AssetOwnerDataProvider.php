<?php

namespace AppBundle\Asset\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use AppBundle\Asset\OwnerableInterface;
use AppBundle\Entity\AssetOwner;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class AssetOwnerDataProvider implements ContainerAwareInterface, CollectionDataProviderInterface, ItemDataProviderInterface
{
    /**
     * @var array
     */
    private $owners;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param array $owners
     */
    public function __construct(array $owners)
    {
        $this->owners = $owners;
    }

    /**
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param string      $resourceClass
     * @param string|null $operationName
     *
     * @return array
     *
     * @throws ResourceClassNotSupportedException
     */
    public function getCollection(string $resourceClass, string $operationName = null): array
    {
        if (AssetOwner::class !== $resourceClass) {
            throw new ResourceClassNotSupportedException();
        }

        return $this->getOwners();
    }

    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @param int|string $id
     * @param array $context
     *
     * @throws ResourceClassNotSupportedException
     *
     * @return object|null
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        if (AssetOwner::class !== $resourceClass) {
            throw new ResourceClassNotSupportedException();
        }

        $owners = $this->getOwners();

        /** @var AssetOwner $owner */
        foreach ($owners as $owner) {
            if ((int) $id === (int) $owner->getId()) {
                return $owner;
            }
        }
    }

    /**
     * @return array
     */
    private function getOwners(): array
    {
        $owners = [];
        foreach ($this->owners as $id => $owner) {
            /** @var OwnerableInterface $object */
            $reflection = new \ReflectionObject($this->container->get($owner));

            preg_match_all('/((?:^|[A-Z])[a-z]+)/', $reflection->getShortName(), $matches);

            $assetOwner = new AssetOwner();
            $assetOwner->setId($id);
            $assetOwner->setServiceId($owner);
            $assetOwner->setName(implode(' ', $matches[1]));

            $owners[] = $assetOwner;
        }

        return $owners;
    }
}