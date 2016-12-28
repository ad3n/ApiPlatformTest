<?php

namespace AppBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class PromotionCompilerPass implements CompilerPassInterface
{
    const SERVICETAG = 'promotion';
    const FACTORY = 'app.promotion.promotion_factory';

    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition(self::FACTORY)) {
            return;
        }

        $definition = $container->findDefinition(self::FACTORY);

        $promotions = [];
        $indexStart = 1;

        $taggedServices = $container->findTaggedServiceIds(self::SERVICETAG);
        foreach ($taggedServices as $id => $tags) {
            $promotions[$indexStart] = $id;

            $definition->addMethodCall('addPromotion', [$id, new Reference($id)]);

            ++$indexStart;
        }

        $container->setParameter(self::SERVICETAG, $promotions);
    }
}
