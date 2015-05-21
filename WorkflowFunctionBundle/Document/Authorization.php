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
     * @var string $name
     *
     * @ODM\Field(type="string")
     */
    protected $name;

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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set workflowFunctions
     *
     * @param ArrayCollection
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
