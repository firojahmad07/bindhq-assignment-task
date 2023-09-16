<?php
namespace Spygar\MarketingBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\Config\FileLocator;

class SpygarMarketingExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $containerBuilder)
    {
        $loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('commands.yaml');
        $loader->load('controllers.yaml');
        $loader->load('repositories.yaml');
    }
}