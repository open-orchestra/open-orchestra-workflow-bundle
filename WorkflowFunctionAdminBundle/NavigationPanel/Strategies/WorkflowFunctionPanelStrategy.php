<?php

namespace OpenOrchestra\WorkflowFunctionAdminBundle\NavigationPanel\Strategies;

use OpenOrchestra\Backoffice\NavigationPanel\Strategies\AbstractNavigationPanelStrategy;

/**
 * Class WorkflowFunctionPanelStrategy
 */
class WorkflowFunctionPanelStrategy extends AbstractNavigationPanelStrategy
{
    const ROLE_ACCESS_WORKFLOWFUNCTION = 'ROLE_ACCESS_WORKFLOWFUNCTION';

    /**
     * @param string $parent
     * @param int    $weight
     */
    public function __construct($parent, $weight)
    {
        parent::__construct('workflow_function', self::ROLE_ACCESS_WORKFLOWFUNCTION, $weight, $parent);
    }

    /**
     * @return string
     */
    public function show()
    {
        return $this->render('OpenOrchestraWorkflowFunctionAdminBundle:AdministrationPanel:workflowFunctions.html.twig');
    }
}
