<?php

namespace OpenOrchestra\WorkflowFunction\Repository;

use Doctrine\Common\Collections\Collection;
use OpenOrchestra\ModelInterface\Model\RoleInterface;
use OpenOrchestra\Pagination\Configuration\FinderConfiguration;
use OpenOrchestra\Pagination\Configuration\PaginateFinderConfiguration;
use OpenOrchestra\ModelInterface\Repository\RoleableElementRepositoryInterface;
use OpenOrchestra\Pagination\Configuration\PaginationRepositoryInterface;

/**
 * Interface WorkflowFunctionRepositoryInterface
 */
interface WorkflowFunctionRepositoryInterface extends RoleableElementRepositoryInterface, PaginationRepositoryInterface
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
     * @return Collection
     */
    public function findByRole(RoleInterface $role);
}
