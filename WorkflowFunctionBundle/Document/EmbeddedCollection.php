<?php

namespace OpenOrchestra\WorkflowFunctionBundle\Document;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceMany;
use Doctrine\ODM\MongoDB\Mapping\Annotations\EmbedMany;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class EmbeddedCollection
 */
abstract class EmbeddedCollection
{
    /**
     * init Collections
     */
    public function initCollections()
    {
        $annotationReader = new AnnotationReader();
        $className = get_class($this);

        foreach(get_class_vars($className) as $properties => $value) {
            $reflectionProperty = new \ReflectionProperty($className, $properties);
            $propertyAnnotations = $annotationReader->getPropertyAnnotations($reflectionProperty);
            if ($propertyAnnotations[0] instanceof ReferenceMany || $propertyAnnotations[0] instanceof EmbedMany) {
                $this->$properties = new ArrayCollection();
            }
        }
    }
}
