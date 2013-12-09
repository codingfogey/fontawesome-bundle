<?php

namespace Codingfogey\Bundle\FontAwesomeBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class CodingfogeyFontAwesomeExtension extends Extension implements PrependExtensionInterface
{

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config        = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        if (true === isset($config['customize'])) {
            $container->setParameter('codingfogey_font_awesome.customize', $config['customize']);
        }
        $container->setParameter('codingfogey_font_awesome.output_dir', $config['output_dir']);
        $container->setParameter('codingfogey_font_awesome.assets_dir', $config['assets_dir']);
        $container->setParameter('codingfogey_font_awesome.filter', $config['filter']);
    }

    public function prepend(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');

        $configs = $container->getExtensionConfig($this->getAlias());
        $config  = $this->processConfiguration(new Configuration(), $configs);

        if (true === isset($bundles['AsseticBundle'])) {
            $this->configureAsseticBundle($container, $config);
        }
    }

    protected function configureAsseticBundle(ContainerBuilder $container, array $config)
    {
        $extensions = $container->getExtensions();

        if (true === isset($extensions['assetic'])) {
            $asseticConfig = new AsseticConfiguration;
            $container->prependExtensionConfig(
                'assetic', array('assets' => $asseticConfig->build($config))
            );
        }
    }
}
