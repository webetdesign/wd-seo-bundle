<?php

namespace WebEtDesign\SeoBundle\DependencyInjection;

use Exception;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use WebEtDesign\SeoBundle\Service\SitemapGenerator;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class WDSeoExtension extends Extension
{
    /**
     * {@inheritdoc}
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $processor     = new Processor();
        $config        = $processor->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container,
            new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');

        $container->setParameter('wd_seo.sitemap', $config['sitemap']);

        $section_config = [];
        foreach ($config['section_config'] as $item) {
            $section = $item['section'];
            unset($item['section']);
            $section_config[$section] = $item;
        }
        $container->setParameter('wd_seo.section_config', $section_config);

        $bundles = $container->getParameter('kernel.bundles');
//        if (isset($bundles['PrestaSitemapBundle'])) {
//        }
    }
}
