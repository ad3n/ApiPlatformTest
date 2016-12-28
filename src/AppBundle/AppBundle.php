<?php

namespace AppBundle;

use AppBundle\DependencyInjection\Compiler\AssetOwnerCompilerPass;
use AppBundle\DependencyInjection\Compiler\AssetOwnerRepositoryCompilerPass;
use AppBundle\DependencyInjection\Compiler\PriceCalculatorCompilerPass;
use AppBundle\DependencyInjection\Compiler\PromotionCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AppBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new AssetOwnerCompilerPass());
        $container->addCompilerPass(new PriceCalculatorCompilerPass());
        $container->addCompilerPass(new PromotionCompilerPass());
        $container->addCompilerPass(new AssetOwnerRepositoryCompilerPass());
    }
}
