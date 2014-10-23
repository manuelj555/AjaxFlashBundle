<?php

namespace Manuelj555\Bundle\AjaxFlashBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('manuel_ajax_flash');

        $rootNode->children()
//                ->scalarNode('auto_assets')->defaultFalse()->end()
                ->arrayNode('auto_assets')
                    ->canBeEnabled()
                    ->children()
                        ->arrayNode('pnotify')
                            ->canBeEnabled()
                            ->children()
                                ->scalarNode('type')->end()
                                ->scalarNode('styling')->defaultValue('bootstrap3')->end()
                                ->scalarNode('animation')->defaultValue('none')->end()
                                ->scalarNode('delay')->defaultValue('10000')->end()
                            ->end()
                        ->end()
                        ->arrayNode('sticky')
                            ->canBeEnabled()
                            ->children()
                                ->scalarNode('stickyClass')->end()
//                                ->scalarNode('styling')->defaultValue('bootstrap3')->end()
//                                ->scalarNode('animation')->defaultValue('none')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('mapping')
                    ->useAttributeAsKey('flash_type')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('type')->defaultNull()->end()
                            ->scalarNode('title')->defaultNull()->end()
                            ->scalarNode('icon')->defaultNull()->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
