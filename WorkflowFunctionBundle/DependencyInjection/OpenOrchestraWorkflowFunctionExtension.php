<?php

namespace OpenOrchestra\WorkflowFunctionBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Definition;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class OpenOrchestraWorkflowFunctionExtension extends Extension
{
    /**
     * Loads a specific configuration.
     *
     * @param array            $config   An array of configuration values
     * @param ContainerBuilder $container A ContainerBuilder instance
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     *
     * @api
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $config);

        foreach ($config['document'] as $class => $content) {
            if (is_array($content)) {
                $container->setParameter('open_orchestra_workflow_function.document.' . $class . '.class', $content['class']);
                if (array_key_exists('repository', $content)) {
                    $definition = new Definition($content['repository'], array($content['class']));
                    $definition->setFactory(array(new Reference('doctrine.odm.mongodb.document_manager'), 'getRepository'));
                    $container->setDefinition('open_orchestra_workflow_function.repository.' . $class, $definition);
                }
            }
        }
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('manager.yml');
    }
}
