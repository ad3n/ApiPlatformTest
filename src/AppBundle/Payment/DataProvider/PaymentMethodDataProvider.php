<?php

namespace AppBundle\Payment\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use AppBundle\Entity\PaymentMethod;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class PaymentMethodDataProvider implements ContainerAwareInterface, CollectionDataProviderInterface, ItemDataProviderInterface
{
    /**
     * @var array
     */
    private $paymentMethods;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param array $paymentMethods
     */
    public function __construct(array $paymentMethods)
    {
        $this->paymentMethods = $paymentMethods;
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
        if (PaymentMethod::class !== $resourceClass) {
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
        if (PaymentMethod::class !== $resourceClass) {
            throw new ResourceClassNotSupportedException();
        }

        $paymentMethods = $this->getData();
        /** @var PaymentMethod $paymentMethod */
        foreach ($paymentMethods as $paymentMethod) {
            if ((int) $id === (int) $paymentMethod->getId()) {
                return $paymentMethod;
            }
        }
    }

    /**
     * @return array
     */
    private function getData(): array
    {
        $paymentMethods = [];
        foreach ($this->paymentMethods as $id => $paymentMethod) {
            $reflection = new \ReflectionObject($this->container->get($paymentMethod));

            $calculator = new PaymentMethod();
            $calculator->setId($id);
            $calculator->setServiceId($paymentMethod);
            $calculator->setName(StringUtil::camelCaseToWord($reflection->getShortName()));

            $paymentMethods[] = $calculator;
        }

        return $paymentMethods;
    }
}
