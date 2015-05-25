<?php

namespace OpenOrchestra\WorkflowFunctionBundle\Manager;

use OpenOrchestra\WorkflowFunction\Model\WorkflowRightInterface;
use OpenOrchestra\WorkflowFunction\Model\ReferenceInterface;

/**
 * Class AuthorizationWorkflowRightManager
 */
class AuthorizationWorkflowRightManager
{
    /**
     * Constructor
     *
     * @param string $authorizationClass
     */
    public function __construct($authorizationClass)
    {
        $this->authorizationClass = $authorizationClass;
    }

    /**
     * @param array $references
     * @param WorkflowRightInterface $workflowRight
     *
     * @return WorkflowRightInterface
     */
    public function cleanAuthorization($references, WorkflowRightInterface $workflowRight)
    {
        $authorizations = $workflowRight->getAuthorizations();
        $indexAuthorizations = array();
        foreach ($authorizations as $authorization) {
            $id = $authorization->getReferenceId();
            $indexAuthorizations[$id] = $authorization;
        }
        $authorizationsId = array_keys($indexAuthorizations);

        $indexReferences = array();
        foreach ($references as $reference) {
            if ($reference instanceof ReferenceInterface || method_exists($reference, 'getId')) {
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
            $authorization->setReferenceId($indexReferences[$add]->getId());
            $workflowRight->addAuthorization($authorization);
        }

        return $workflowRight;
    }
}
