<?php

namespace AppBundle\Price\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use AppBundle\Asset\OwnerableInterface;
use AppBundle\Entity\PriceCalculator;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
final class PriceCalculatorDataProvider implements ContainerAwareInterface, CollectionDataProviderInterface, ItemDataProviderInterface
{
    /**
     * @var array
     */
    private $priceCalculators;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param array $priceCalculators
     */
    public function __construct(array $priceCalculators)
    {
        $this->priceCalculators = $priceCalculators;
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
        if (PriceCalculator::class !== $resourceClass) {
            throw new ResourceClassNotSupportedException();
        }

        return $this->getPriceCalculators();
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
        if (PriceCalculator::class !== $resourceClass) {
            throw new ResourceClassNotSupportedException();
        }

        $priceClaculators = $this->getPriceCalculators();
        /** @var PriceCalculator $priceClaculator */
        foreach ($priceClaculators as $priceClaculator) {
            if ((int) $id === (int) $priceClaculator->getId()) {
                return $priceClaculator;
            }
        }
    }

    /**
     * @return array
     */
    private function getPriceCalculators(): array
    {
        $priceCalculators = [];
        foreach ($this->priceCalculators as $id => $priceCalculator) {
            /** @var OwnerableInterface $object */
            $reflection = new \ReflectionObject($this->container->get($priceCalculator));

            preg_match_all('/((?:^|[A-Z])[a-z]+)/', $reflection->getShortName(), $matches);

            $calculator = new PriceCalculator();
            $calculator->setId($id);
            $calculator->setServiceId($priceCalculator);
            $calculator->setName(implode(' ', $matches[1]));

            $priceCalculators[] = $calculator;
        }

        return $priceCalculators;
    }
}
