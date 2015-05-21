<?php

namespace OpenOrchestra\WorkflowFunction\Model;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Interface AuthorizationInterface
 */
interface AuthorizationInterface
{
    /**
     * @param string $name
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param ArrayCollection
     */
    public function setWorkflowFunctions(ArrayCollection $workflowFunctions);

    /**
     * @return ArrayCollection
     */
    public function getWorkflowFunctions();
}
