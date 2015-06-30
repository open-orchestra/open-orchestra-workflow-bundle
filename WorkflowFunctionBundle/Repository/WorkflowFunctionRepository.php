<?php

namespace OpenOrchestra\WorkflowFunctionBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;
use OpenOrchestra\ModelInterface\Repository\Configuration\FinderConfiguration;
use OpenOrchestra\ModelInterface\Repository\Configuration\PaginateFinderConfiguration;
use OpenOrchestra\WorkflowFunction\Repository\WorkflowFunctionRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use OpenOrchestra\ModelInterface\Model\RoleInterface;

/**
 * Class WorkflowFunctionRepository
 */
class WorkflowFunctionRepository extends DocumentRepository implements WorkflowFunctionRepositoryInterface
{
    /**
     * @param array|null  $descriptionEntity
     * @param array|null  $columns
     * @param string|null $search
     * @param array|null  $order
     * @param int|null    $skip
     * @param int|null    $limit
     *
     * @deprecated will be removed in 0.3.0, use findForPaginate instead
     *
     * @return array
     */
    public function findForPaginateAndSearch($descriptionEntity = null, $columns = null, $search = null, $order = null, $skip = null, $limit = null)
    {
        $qb = $this->createQueryWithSearchAndOrderFilter($descriptionEntity, $columns, $search, $order);

        if (null !== $skip && $skip > 0) {
            $qb->skip($skip);
        }

        if (null !== $limit) {
            $qb->limit($limit);
        }

        return $qb->getQuery()->execute();
    }

    /**
     * @param PaginateFinderConfiguration $configuration
     *
     * @return array
     */
    public function findForPaginate(PaginateFinderConfiguration $configuration)
    {
        $qb = $this->createQueryWithFilterAndOrder($configuration->getFinderConfiguration(), $configuration->getOrder());

        $skip = $configuration->getSkip();
        if (null !== $skip && $skip > 0) {
            $qb->skip($skip);
        }

        $limit = $configuration->getLimit();
        if (null !== $limit) {
            $qb->limit($limit);
        }

        return $qb->getQuery()->execute();
    }

    /**
     * @return int
     */
    public function count()
    {
        $qb = $this->createQueryBuilder();

        return $qb->count()->getQuery()->execute();
    }

    /**
     * @param array|null  $columns
     * @param array|null  $descriptionEntity
     * @param string|null $search
     *
     * @deprecated will be removed in 0.3.0, use countWithFilter instead
     *
     * @return int
     */
    public function countWithSearchFilter($descriptionEntity = null, $columns = null, $search = null)
    {
        $qb = $this->createQueryWithSearchFilter($descriptionEntity, $columns, $search);

        return $qb->count()->getQuery()->execute();
    }

    /**
     * @param FinderConfiguration $configuration
     *
     * @return mixed
     */
    public function countWithFilter(FinderConfiguration $configuration)
    {
        $qb = $this->createQueryWithFilter($configuration);

        return $qb->count()->getQuery()->execute();
    }

    /**
     * @return Collection
     */
    public function findAllWorkflowFunction()
    {
        $qb = $this->createQueryBuilder();

        return $qb->getQuery()->execute();
    }

    /**
     * @param RoleInterface $role
     *
     * @return ArrayCollection
     */
    public function findByRole(RoleInterface $role)
    {
        $qb = $this->createQueryBuilder();
        $qb->field('roles.id')->equals($role->getId());

        return $qb->getQuery()->execute();
    }

    /**
     * @param string $value
     * @param string $type
     *
     * @return mixed
     */
    protected function getFilterSearchField($value, $type)
    {
        if ($type == 'integer') {
            $filter = (int) $value;
        } elseif ($type == 'boolean') {
            $value = ($value === 'true' || $value === '1') ? true : false;
            $filter = $value;
        } else {
            $value = preg_quote($value);
            $filter = new \MongoRegex('/.*'.$value.'.*/i');
        }

        return $filter;
    }

    /**
     * @param array|null  $descriptionEntity
     * @param array|null  $columns
     * @param string|null $search
     *
     * @deprecated will be removed in 0.3.0, use createQueryWithFilter instead
     *
     * @return \Doctrine\ODM\MongoDB\Query\Builder
     */
    protected function createQueryWithSearchFilter($descriptionEntity = null, $columns = null, $search = null)
    {
        $configuration = new FinderConfiguration();
        $configuration->setColumns($columns);
        $configuration->setDescriptionEntity($descriptionEntity);
        $configuration->setSearch($search);

        return $this->createQueryWithFilter($configuration);
    }

    /**
     * @param FinderConfiguration $configuration
     *
     * @return \Doctrine\ODM\MongoDB\Query\Builder
     */
    protected function createQueryWithFilter(FinderConfiguration $configuration)
    {
        $qb = $this->createQueryBuilder();
        $columns = $configuration->getColumns();
        $descriptionEntity = $configuration->getDescriptionEntity();
        if (null !== $columns) {
            foreach ($columns as $column) {
                $columnsName = $column['name'];
                if (isset($descriptionEntity[$columnsName]) && isset($descriptionEntity[$columnsName]['key'])) {
                    $descriptionAttribute = $descriptionEntity[$columnsName];
                    $name = $descriptionAttribute['key'];
                    $type = isset($descriptionAttribute['type']) ? $descriptionAttribute['type'] : null;
                    if ($column['searchable'] && !empty($column['search']['value']) && !empty($name)) {
                        $value = $column['search']['value'];
                        $qb->addAnd($qb->expr()->field($name)->equals($this->getFilterSearchField($value, $type)));
                    }
                    $search = $configuration->getSearch();
                    if (!empty($search) && $column['searchable'] && !empty($name)) {
                        $qb->addOr($qb->expr()->field($name)->equals($this->getFilterSearchField($search, $type)));
                    }
                }
            }
        }
        return $qb;
    }

    /**
     * @param array|null  $descriptionEntity
     * @param array|null  $columns
     * @param string|null $search
     * @param array|null  $order
     *
     * @deprecated will be remove in 0.3.0, use createQueryWithFilterAndOrder instead
     *
     * @return \Doctrine\ODM\MongoDB\Query\Builder
     */
    protected function createQueryWithSearchAndOrderFilter($descriptionEntity = null, $columns = null, $search = null, $order = null)
    {
        $configuration = new FinderConfiguration();
        $configuration->setColumns($columns);
        $configuration->setDescriptionEntity($descriptionEntity);
        $configuration->setSearch($search);

        return $this->createQueryWithFilterAndOrder($configuration, $order);
    }

    /**
     * @param FinderConfiguration $configuration
     * @param array|null          $order
     *
     * @return \Doctrine\ODM\MongoDB\Query\Builder
     */
    protected function createQueryWithFilterAndOrder(FinderConfiguration $configuration, $order = null)
    {
        $qb = $this->createQueryWithFilter($configuration);
        $columns = $configuration->getColumns();
        $descriptionEntity = $configuration->getDescriptionEntity();
        if (null !== $order && null !== $columns) {
            foreach ($order as $orderColumn) {
                $numberColumns = $orderColumn['column'];
                if ($columns[$numberColumns]['orderable']) {
                    if (!empty($columns[$numberColumns]['name'])) {
                        $columnsName = $columns[$numberColumns]['name'];
                        if (isset($descriptionEntity[$columnsName]) && isset($descriptionEntity[$columnsName]['key'])) {
                            $name = $descriptionEntity[$columnsName]['key'];
                            $dir = ($orderColumn['dir'] == 'desc') ? -1 : 1;
                            $qb->sort($name, $dir);
                        }
                    }
                }
            }
        }

        return $qb;
    }
}
