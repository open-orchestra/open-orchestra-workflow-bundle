<?php

namespace OpenOrchestra\WorkflowFunction\Model;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Interface AuthorizationInterface
 */
interface AuthorizationInterface
{
    /**
     * @param string $referenceId
     */
    public function setReferenceId($referenceId);

    /**
     * @return string
     */
    public function getReferenceId();

    /**
     * @param ArrayCollection
     */
    public function setWorkflowFunctions(ArrayCollection $workflowFunctions);

    /**
     * @return ArrayCollection
     */
    public function getWorkflowFunctions();
}
