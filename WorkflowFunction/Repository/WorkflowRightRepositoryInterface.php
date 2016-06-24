<?php

namespace OpenOrchestra\WorkflowFunction\Repository;

use OpenOrchestra\WorkflowFunction\Model\WorkflowFunctionInterface;

/**
 * Interface WorkflowFunctionRepositoryInterface
 */
interface WorkflowRightRepositoryInterface
{
    /**
     * @param string $userId
     *
     * @return  \OpenOrchestra\WorkflowFunction\Model\WorkflowRightInterface
     */
    public function findOneByUserId($userId);

    /**
     * @param string $id
     *
     * @return mixed
     */
    public function find($id);

    /**
     * @param WorkflowFunctionInterface $workflowFunction
     *
     * @return bool
     */
    public function hasElementWithWorkflowFunction(WorkflowFunctionInterface $workflowFunction);
}
