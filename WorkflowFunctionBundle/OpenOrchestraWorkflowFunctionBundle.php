<?php

namespace OpenOrchestra\WorkflowFunctionBundle;

use OpenOrchestra\WorkflowFunctionBundle\DependencyInjection\Compiler\EntityResolverCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class OpenOrchestraWorkflowFunctionBundle
 */
class OpenOrchestraWorkflowFunctionBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new EntityResolverCompilerPass());
    }
}
