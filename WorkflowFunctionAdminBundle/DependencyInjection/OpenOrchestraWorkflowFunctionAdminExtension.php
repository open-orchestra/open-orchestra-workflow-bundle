<?php

namespace OpenOrchestra\WorkflowFunctionAdminBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class OpenOrchestraWorkflowFunctionAdminExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        foreach ($config['facades'] as $transformer => $facade) {
            $container->setParameter('open_orchestra_workflow_function_admin.facade.' . $transformer .'.class', $facade);
        }

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('form.yml');
        $loader->load('transformer.yml');
        $loader->load('manager.yml');
        $loader->load('authorize_status_change.yml');
        $loader->load('subscriber.yml');
        $loader->load('role_parameter.yml');

        $container->setParameter('open_orchestra_backoffice.collector.backoffice_role.workflow_role_in_group', false);
    }
}
