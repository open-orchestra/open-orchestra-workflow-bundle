<?php

namespace OpenOrchestra\WorkflowFunctionBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use OpenOrchestra\WorkflowFunction\Model\AuthorizationInterface;
use OpenOrchestra\WorkflowFunctionBundle\MongoTrait\EmbeddedCollection;

/**
 * Description of Authorization
 *
 * @ODM\EmbeddedDocument
 */
class Authorization implements AuthorizationInterface
{
    use EmbeddedCollection;
    /**
     * @var string $referenceId
     *
     * @ODM\Field(type="string")
     */
    protected $referenceId;

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
        $this->initCollections();
    }

    /**
     * Set referenceId
     *
     * @param string $referenceId
     */
    public function setReferenceId($referenceId)
    {
        $this->referenceId = $referenceId;
    }

    /**
     * Get referenceId
     *
     * @return string
     */
    public function getReferenceId()
    {
        return $this->referenceId;
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
        $this->initCollections();
    }
}
