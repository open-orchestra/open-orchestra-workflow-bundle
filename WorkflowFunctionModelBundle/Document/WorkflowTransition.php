<?php

namespace OpenOrchestra\WorkflowFunctionModelBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use OpenOrchestra\WorkflowFunction\Model\WorkflowTransitionInterface;
use OpenOrchestra\ModelInterface\Model\StatusInterface;

/**
 * @ODM\EmbeddedDocument
 */
class WorkflowTransition implements WorkflowTransitionInterface
{
    /**
     * @var OpenOrchestra\ModelInterface\Model\StatusInterface
     *
     * @ODM\EmbedOne(targetDocument="OpenOrchestra\ModelInterface\Model\StatusInterface")
     */
    protected $statusFrom;

    /**
     * @var OpenOrchestra\ModelInterface\Model\StatusInterface
     *
     * @ODM\EmbedOne(targetDocument="OpenOrchestra\ModelInterface\Model\StatusInterface")
     */
    protected $statusTo;

    /**
     * @param string $status
     */
    public function setStatusFrom(StatusInterface $status)
    {
        $this->statusFrom = $status;
    }

    /**
     * @param string $status
     */
    public function setStatusTo(StatusInterface $status)
    {
        $this->statusTo = $status;
    }
}
