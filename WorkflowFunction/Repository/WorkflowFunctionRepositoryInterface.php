<?php

namespace OpenOrchestra\WorkflowFunction\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use OpenOrchestra\ModelInterface\Model\RoleInterface;

/**
 * Interface WorkflowFunctionRepositoryInterface
 */
interface WorkflowFunctionRepositoryInterface
{
    /**
     * @return Collection
     */
    public function findAllWorkflowFunction();

    /**
     * @param string $id
     *
     * @return mixed
     */
    public function find($id);

    /**
     * @param RoleInterface $role
     *
     * @return ArrayCollection
     */
    public function findByRole(RoleInterface $role);
}
