<?php

namespace OpenOrchestra\WorkflowFunctionBundle\MongoTrait;

/**
 * Trait EmbeddedCollection
 *
 */
trait EmbeddedCollection
{
    /**
     * init Collections
     */
    protected function initCollections()
    {
        foreach(get_class_vars((get_class($this))) as $properties) {
            if ($properties instanceof ArrayCollection) {
                $this->$properties = new ArrayCollection();
            }
        }
    }
}
