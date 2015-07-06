<?php

namespace OpenOrchestra\WorkflowFunction\Repository;

use Doctrine\Common\Collections\Collection;
use OpenOrchestra\ModelInterface\Model\RoleInterface;
use OpenOrchestra\Pagination\Configuration\FinderConfiguration;
use OpenOrchestra\Pagination\Configuration\PaginateFinderConfiguration;

/**
 * Interface WorkflowFunctionRepositoryInterface
 */
interface WorkflowFunctionRepositoryInterface
{
    /**
     * @param array|null $descriptionEntity
     * @param array|null $columns
     * @param string|null $search
     * @param array|null $order
     * @param int|null $skip
     * @param int|null $limit
     *
     * @deprecated will be removed in 0.3.0, use findForPaginate instead
     *
     * @return array
     */
    public function findForPaginateAndSearch($descriptionEntity = null, $columns = null, $search = null, $order = null, $skip = null, $limit = null);

    /**
     * @param PaginateFinderConfiguration $configuration
     *
     * @return mixed
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function findForPaginate(PaginateFinderConfiguration $configuration);

    /**
     * @return int
     */
    public function count();

    /**
     * @param array|null $columns
     * @param array|null $descriptionEntity
     * @param array|null $search
     *
     * @deprecated will be removed in 0.3.0, use countWithFilter instead
     *
     * @return int
     */
    public function countWithSearchFilter($descriptionEntity = null, $columns = null, $search = null);

    /**
     * @param FinderConfiguration $configuration
     *
     * @return mixed
     */
    public function countWithFilter(FinderConfiguration $configuration);

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
