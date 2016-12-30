<?php

namespace AppBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class ProductRepositoryCompilerPass implements CompilerPassInterface
{
    const SERVICETAG = 'product_repository';
    const SERVICEID = 'app.product.product_factory';

    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition(self::SERVICEID)) {
            return;
        }

        $definition = $container->getDefinition(self::SERVICEID);

        $taggedServices = $container->findTaggedServiceIds(self::SERVICETAG);
        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('addRepository', [new Reference($id)]);
        }
    }
}
