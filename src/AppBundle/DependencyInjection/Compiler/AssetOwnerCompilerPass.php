<?php

namespace AppBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class AssetOwnerCompilerPass implements CompilerPassInterface
{
    const SERVICETAG = 'asset_owner';

    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $assetOwners = [];
        $indexStart = 1;

        $taggedServices = $container->findTaggedServiceIds(self::SERVICETAG);
        foreach ($taggedServices as $id => $tags) {
            $assetOwners[$indexStart] = $id;

            ++$indexStart;
        }

        $container->setParameter(self::SERVICETAG, $assetOwners);
    }
}
