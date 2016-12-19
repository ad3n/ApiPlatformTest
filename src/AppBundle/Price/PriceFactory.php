<?php

namespace AppBundle\Price;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
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
     * @var PriceLogInterface
     */
    private $priceLog;

    /**
     * @param ObjectManager     $objectManager
     * @param PriceLogInterface $priceLog
     */
    public function __construct(ObjectManager $objectManager, PriceLogInterface $priceLog)
    {
        $this->objectManager = $objectManager;
        $this->priceLog = $priceLog;
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

        $price = $calculator->calculate($pricable);
        $pricable->setPrice($price);

        $this->priceLog->setSource($pricable);
        $this->priceLog->setDateTime(new \DateTime());
        $this->objectManager->persist($this->priceLog);
        $this->objectManager->flush();
    }
}
