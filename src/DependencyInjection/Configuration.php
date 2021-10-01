<?php

namespace WebEtDesign\SeoBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('wd_seo');

        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
            ->arrayNode('section_config')
                ->arrayPrototype()
                ->children()
                    ->scalarNode('section')->isRequired()->cannotBeEmpty()->end()
                    ->scalarNode('host')->cannotBeEmpty()->end()
                    ->scalarNode('scheme')->cannotBeEmpty()->end()
                ->end()
            ->end()
            ->end()
            ->arrayNode('sitemap')
                ->arrayPrototype()
                ->addDefaultsIfNotSet()
                ->children()
                    ->scalarNode('section')->isRequired()->end()
                    ->scalarNode('query')->isRequired()->end()
                    ->scalarNode('route')->isRequired()->end()
                    ->arrayNode('parameters')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('lastmod')->cannotBeEmpty()->end()
                            ->scalarNode('lastmod_format')->cannotBeEmpty()->end()
                            ->floatNode('priority')->min(0)->max(1)->end()
                            ->enumNode('changefreq')
                                ->values(['always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never'])
                            ->end()
                        ->end()
                    ->end()
                    ->arrayNode('query_parameters')
                        ->scalarPrototype()
                        ->end()
                    ->end()
                    ->scalarNode('host')->defaultNull()->end()
                    ->scalarNode('scheme')->defaultNull()->end()
                ->end()
            ->end()
            ->end();

        return $treeBuilder;
    }
}
