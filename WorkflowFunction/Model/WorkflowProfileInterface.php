<?php

namespace OpenOrchestra\WorkflowFunction\Model;

/**
 * Interface WorkflowProfileInterface
 */
interface WorkflowProfileInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @param WorkflowTransitionInterface $transition
     */
    public function addTransition(WorkflowTransitionInterface $transition);
}
