<?php

namespace OpenOrchestra\WorkflowFunctionAdminBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class
 * }
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('open_orchestra_workflow_function_admin');

        $rootNode->children()
            ->arrayNode('transformer')
                ->addDefaultsIfNotSet()
                ->children()
                    ->arrayNode('workflow_function')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('facade')->defaultValue('OpenOrchestra\WorkflowFunctionAdminBundle\Facade\WorkflowFunctionFacade')->end()
                        ->end()
                    ->end()
                    ->arrayNode('workflow_function_collection')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('facade')->defaultValue('OpenOrchestra\WorkflowFunctionAdminBundle\Facade\WorkflowFunctionCollectionFacade')->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}
