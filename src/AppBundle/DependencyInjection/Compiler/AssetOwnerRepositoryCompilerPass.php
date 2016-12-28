<?php

namespace AppBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class AssetOwnerRepositoryCompilerPass implements CompilerPassInterface
{
    const SERVICETAG = 'asset_owner_repository';
    const SERVICEID = 'app.asset.factory.asset_owner_factory';

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
            $definition->addMethodCall('addAssetOwnerRepository', [new Reference($id)]);
        }
    }
}
