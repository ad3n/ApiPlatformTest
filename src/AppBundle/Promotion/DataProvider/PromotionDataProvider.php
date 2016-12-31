<?php

namespace AppBundle\Promotion\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use AppBundle\Entity\PromotionProvider;
use AppBundle\Util\StringUtil;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
final class PromotionDataProvider implements ContainerAwareInterface, CollectionDataProviderInterface, ItemDataProviderInterface
{
    /**
     * @var array
     */
    private $promotionProviders;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param array $promotionProviders
     */
    public function __construct(array $promotionProviders)
    {
        $this->promotionProviders = $promotionProviders;
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
        if (PromotionProvider::class !== $resourceClass) {
            throw new ResourceClassNotSupportedException();
        }

        return $this->getData();
    }

    /**
     * @param string      $resourceClass
     * @param string|null $operationName
     * @param int|string  $id
     * @param array       $context
     *
     * @throws ResourceClassNotSupportedException
     *
     * @return object|null
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        if (PromotionProvider::class !== $resourceClass) {
            throw new ResourceClassNotSupportedException();
        }

        $promotionProviders = $this->getData();
        foreach ($promotionProviders as $promotionProvider) {
            /** @var PromotionProvider $promotionProvider */
            if ((int) $id === (int) $promotionProvider->getId()) {
                return $promotionProvider;
            }
        }
    }

    /**
     * @return array
     */
    private function getData(): array
    {
        $promotionProviders = [];
        foreach ($this->promotionProviders as $id => $promotionProvider) {
            $reflection = new \ReflectionObject($this->container->get($promotionProvider));

            $calculator = new PromotionProvider();
            $calculator->setId($id);
            $calculator->setServiceId($promotionProvider);
            $calculator->setName(StringUtil::camelCaseToWord($reflection->getShortName()));

            $promotionProviders[] = $calculator;
        }

        return $promotionProviders;
    }
}
