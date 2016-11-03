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
 *   collection="workflow_function",
 *   repositoryClass="OpenOrchestra\WorkflowFunctionModelBundle\Repository\WorkflowFunctionRepository"
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
     * @var Collection
     *
     * @ODM\EmbedMany(targetDocument="OpenOrchestra\WorkflowFunction\Model\WorkflowTransitionInterface")
     */
    protected $transitions;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->initCollections();
    }

    /**
     * Clone the element
     */
    public function __clone()
    {
        $this->initCollections();
    }

    protected function initCollections() {
        $this->transitions = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param WorkflowTransitionInterface $transition
     */
    public function addTransition(WorkflowTransitionInterface $transition)
    {
        $this->transitions->add($transition);
    }
}
