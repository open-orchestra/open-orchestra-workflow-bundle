<?php

namespace OpenOrchestra\WorkflowFunctionBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use OpenOrchestra\WorkflowFunction\Model\AuthorizationInterface;

/**
 * Description of Authorization
 *
 * @ODM\EmbeddedDocument
 */
class Authorization implements AuthorizationInterface
{
    /**
     * @var string $id
     */
    protected $id;

    /**
     * @var ArrayCollection $workflowFunctions
     *
     * @ODM\ReferenceMany(targetDocument="OpenOrchestra\WorkflowFunction\Model\WorkflowFunctionInterface")
     */
    protected $workflowFunctions;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->workflowFunctions = new ArrayCollection();
    }

    /**
     * Set id
     *
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set workflowFunctions
     *
     * @param ArrayCollection $workflowFunctions
     */
    public function setWorkflowFunctions(ArrayCollection $workflowFunctions)
    {
        $this->workflowFunctions = $workflowFunctions;
    }

    /**
     * Get workflowFunctions
     *
     * @return ArrayCollection
     */
    public function getWorkflowFunctions()
    {
        return $this->workflowFunctions;
    }

    /**
     * Clone the element
     */
    public function __clone()
    {
        $this->workflowFunctions = new ArrayCollection();
    }
}
