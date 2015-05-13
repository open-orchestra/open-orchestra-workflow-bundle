<?php

namespace OpenOrchestra\WorkflowFonction\Event;

use OpenOrchestra\WorkflowFonction\Model\WorkflowFonctionInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class WorkflowFonctionEvent
 */
class WorkflowFonctionEvent extends Event
{
    protected $workflowFonction;

    /**
     * @param WorkflowFonctionInterface $workflowFonction
     */
    public function __construct(WorkflowFonctionInterface $workflowFonction)
    {
        $this->workflowFonction = $workflowFonction;
    }

    /**
     * @return WorkflowFonctionInterface
     */
    public function getWorkflowFonction()
    {
        return $this->workflowFonction;
    }
}
