<?php

namespace OpenOrchestra\WorkflowFunction\Manager;

use Doctrine\Common\Collections\ArrayCollection;
use OpenOrchestra\WorkflowFunction\Model\AuthorizationInterface;
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
     * @param array                  $references
     * @param WorkflowRightInterface $workflowRight
     *
     * @return WorkflowRightInterface
     */
    public function cleanAuthorization(array $references, WorkflowRightInterface $workflowRight)
    {
        $authorizations = $workflowRight->getAuthorizations();
        $indexAuthorizations = $this->indexList($authorizations, "getReferenceId", "AuthorizationInterfaces");

        $indexReferences = $this->indexList($references, "getId", "ReferenceInterface");

        $AuthorizationNotInReference = array_diff_key($indexAuthorizations, $indexReferences);
        foreach ($AuthorizationNotInReference as $remove) {
            $workflowRight->removeAuthorization($remove);
        }

        $authorizationClass = $this->authorizationClass;
        $ReferenceNotInAuthorization = array_diff_key($indexReferences, $indexAuthorizations);
        foreach ($ReferenceNotInAuthorization as $add) {
            $authorization = new $authorizationClass();
            $authorization->setReferenceId($add->getId());
            $workflowRight->addAuthorization($authorization);
        }

        return $workflowRight;
    }

    /**
     * @param array|ArrayCollection  $list
     * @param string                 $getter
     * @param string                 $type
     *
     * @return array
     */
    private function indexList($list, $getter, $type)
    {
        $referenceArray = array();
        foreach ($list as $value) {
            if($value instanceof $type || method_exists($value, $getter)){
                $id = $value->$getter();
                $referenceArray[$id] = $value;
            }
        }
        return $referenceArray;
    }
}
