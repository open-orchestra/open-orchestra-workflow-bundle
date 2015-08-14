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
     * @return string
     */
    public function show()
    {
        return $this->render('OpenOrchestraWorkflowFunctionAdminBundle:AdministrationPanel:workflowFunctions.html.twig');
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return self::ADMINISTRATION;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'workflow_function';
    }

    /**
     * @return int
     */
    public function getWeight()
    {
        return 110;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return self::ROLE_ACCESS_WORKFLOWFUNCTION;
    }
}
