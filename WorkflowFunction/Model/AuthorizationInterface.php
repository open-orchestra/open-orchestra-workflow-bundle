<?php

namespace OpenOrchestra\WorkflowFunction\Model;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Interface AuthorizationInterface
 */
interface AuthorizationInterface
{
    /**
     * @param string $id
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getId();

    /**
     * @param ArrayCollection
     */
    public function setWorkflowFunctions(ArrayCollection $workflowFunctions);

    /**
     * @return ArrayCollection
     */
    public function getWorkflowFunctions();
}
