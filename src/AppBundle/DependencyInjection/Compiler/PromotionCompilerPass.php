<?php

namespace AppBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class PromotionCompilerPass implements CompilerPassInterface
{
    const SERVICETAG = 'promotion';

    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $promotions = [];
        $indexStart = 1;

        $taggedServices = $container->findTaggedServiceIds(self::SERVICETAG);
        foreach ($taggedServices as $id => $tags) {
            $promotions[$indexStart] = $id;

            ++$indexStart;
        }

        $container->setParameter(self::SERVICETAG, $promotions);
    }
}
