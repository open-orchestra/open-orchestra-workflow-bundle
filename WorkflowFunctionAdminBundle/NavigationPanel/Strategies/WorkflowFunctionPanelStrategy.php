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
        $this->parent = $parent;
        $this->weight = $weight;
    }

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
    public function getName()
    {
        return 'workflow_function';
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return self::ROLE_ACCESS_WORKFLOWFUNCTION;
    }
}
