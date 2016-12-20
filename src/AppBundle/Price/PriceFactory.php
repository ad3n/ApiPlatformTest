<?php

namespace AppBundle\Price;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class PriceFactory implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var string
     */
    private $priceLogClass;

    /**
     * @param ObjectManager $objectManager
     * @param string        $priceLogClass
     */
    public function __construct(ObjectManager $objectManager, string $priceLogClass)
    {
        $this->objectManager = $objectManager;
        $this->priceLogClass = $priceLogClass;
    }

    /**
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param PricableInterface $pricable
     */
    public function calculate(PricableInterface $pricable)
    {
        $serviceId = $pricable->getPriceCalculatorServiceId();
        $calculator = $this->container->get($serviceId);

        if (!$calculator instanceof PriceCalculatorInterface) {
            throw new ServiceNotFoundException($serviceId);
        }

        $calculator->calculate($pricable);

        /** @var PriceLogInterface $priceLogger */
        $priceLogger = new $this->priceLogClass();
        if (!$priceLogger instanceof PriceLogInterface) {
            throw new InvalidArgumentException(sprintf('Class %s is not implements "\AppBundle\Price\PriceLogInterface"'));
        }

        $priceLogger->setSource($pricable);
        $priceLogger->setDateTime(new \DateTime());
        $this->objectManager->persist($priceLogger);
        $this->objectManager->flush();
    }
}
