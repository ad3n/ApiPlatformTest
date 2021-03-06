<?php

namespace AppBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class PriceCalculatorCompilerPass implements CompilerPassInterface
{
    const SERVICETAG = 'price_calculator';

    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $priceCalculators = [];
        $indexStart = 1;

        $taggedServices = $container->findTaggedServiceIds(self::SERVICETAG);
        foreach ($taggedServices as $id => $tags) {
            $priceCalculators[$indexStart] = $id;

            ++$indexStart;
        }

        $container->setParameter(self::SERVICETAG, $priceCalculators);
    }
}
