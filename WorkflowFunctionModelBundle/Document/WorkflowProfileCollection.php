<?php

namespace OpenOrchestra\WorkflowFunctionModelBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use OpenOrchestra\WorkflowFunction\Model\WorkflowProfileCollectionInterface;
use OpenOrchestra\WorkflowFunction\Model\WorkflowProfileInterface;

/**
 * @ODM\EmbeddedDocument
 */
class WorkflowProfileCollection implements WorkflowProfileCollectionInterface
{
    /**
     * @var ArrayCollection
     *
     * @ODM\ReferenceMany(
     *  targetDocument="OpenOrchestra\WorkflowFunction\Model\WorkflowProfileInterface"
     * )
     */
    protected $profiles;

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

    /**
     * @param WorkflowProfileInterface $profile
     */
    public function addProfile(WorkflowProfileInterface $profile)
    {
        $this->profiles->add($profile);
    }

    /**
     * Init collections
     */
    protected function initCollections() {
        $this->profiles = new ArrayCollection();
    }
}
