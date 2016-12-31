<?php

namespace AppBundle\Price\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use AppBundle\Entity\PriceCalculator;
use AppBundle\Util\StringUtil;
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
        if (PriceCalculator::class !== $resourceClass) {
            throw new ResourceClassNotSupportedException();
        }

        $priceCalculators = $this->getData();
        /** @var PriceCalculator $priceCalculator */
        foreach ($priceCalculators as $priceCalculator) {
            if ((int) $id === (int) $priceCalculator->getId()) {
                return $priceCalculator;
            }
        }
    }

    /**
     * @return array
     */
    private function getData(): array
    {
        $priceCalculators = [];
        foreach ($this->priceCalculators as $id => $priceCalculator) {
            $reflection = new \ReflectionObject($this->container->get($priceCalculator));

            $calculator = new PriceCalculator();
            $calculator->setId($id);
            $calculator->setServiceId($priceCalculator);
            $calculator->setName(StringUtil::camelCaseToWord($reflection->getShortName()));

            $priceCalculators[] = $calculator;
        }

        return $priceCalculators;
    }
}
