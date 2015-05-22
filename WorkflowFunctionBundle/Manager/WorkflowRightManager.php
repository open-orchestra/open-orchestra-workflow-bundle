<?php

namespace OpenOrchestra\WorkflowFunctionBundle\Manager;

use Doctrine\ODM\MongoDB\DocumentManager;

/**
 * Class WorkflowRightManager
 */
class WorkflowRightManager
{
    protected $documentManager;

    /**
     * Constructor
     *
     * @param string $authorizationClass
     * @param string $workflowRightClass
     */
    public function __construct($authorizationClass, $workflowRightClass)
    {
        $this->authorizationClass = $authorizationClass;
        $this->workflowRightClass = $workflowRightClass;
    }

    /**
     * @param array $references
     * @param WorkflowRightInterface|null $workflowRight
     *
     * @return WorkflowRightInterface
     */
    public function clean($references, $workflowRight = null)
    {
        if (null === $workflowRight) {
            $workflowRightClass = $this->workflowRightClass;
            $workflowRight = new $workflowRightClass();
        }

        $authorizations = $workflowRight->getAuthorizations();
        $indexAuthorizations = array();
        foreach ($authorizations as $authorization) {
            $id = $authorization->getId();
            $indexAuthorizations[$id] = $authorization;
        }
        $authorizationsId = array_keys($indexAuthorizations);

        $indexReferences = array();
        foreach ($references as $reference) {
            if (method_exists($reference, 'getId')) {
                $id = $reference->getId();
                $indexReferences[$id] = $reference;
            }
        }
        $referencesId = array_keys($indexReferences);

        $removes = array_diff($authorizationsId, $referencesId);
        foreach ($removes as $remove) {
            $workflowRight->removeAuthorization($indexAuthorizations[$remove]);
        }

        $authorizationClass = $this->authorizationClass;
        $adds = array_diff($referencesId, $authorizationsId);
        foreach ($adds as $add) {
            $authorization = new $authorizationClass();
            $authorization->setId($indexReferences[$add]->getId());
            $workflowRight->addAuthorization($authorization);
        }

        return $workflowRight;
    }
}
