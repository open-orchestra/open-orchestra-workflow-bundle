<?php

namespace OpenOrchestra\WorkflowFunctionModelBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use OpenOrchestra\WorkflowFunction\Model\WorkflowProfileInterface;
use OpenOrchestra\WorkflowFunction\Model\WorkflowTransitionInterface;

/**
 * Class WorkflowProfile
 *
 * @ODM\Document(
 *   collection="workflow_profile",
 *   repositoryClass="OpenOrchestra\WorkflowFunctionModelBundle\Repository\WorkflowProfileRepository"
 * )
 */
class WorkflowProfile implements WorkflowProfileInterface
{
    /**
     * @var string $id
     *
     * @ODM\Id
     */
    protected $id;

    /**
     * @var string $label
     *
     * @ODM\String
     */
    protected $label = '';

    /**
     * @var Collection
     *
     * @ODM\EmbedMany(targetDocument="OpenOrchestra\WorkflowFunction\Model\WorkflowTransitionInterface")
     */
    protected $transitions;

    /**
     * Constructor
     *
     * @param string $label
     */
    public function __construct($label = '')
    {
        $this->initCollections();
        $this->label = $label;
    }

    /**
     * Clone the element
     */
    public function __clone()
    {
        $this->initCollections();
    }

    /**
     * @param WorkflowTransitionInterface $transition
     */
    public function addTransition(WorkflowTransitionInterface $transition)
    {
        $this->transitions->add($transition);
    }

    /**
     * Initialize collections
     */
    protected function initCollections() {
        $this->transitions = new ArrayCollection();
    }
}
