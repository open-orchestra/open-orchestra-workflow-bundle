<?php

namespace OpenOrchestra\WorkflowFunctionModelBundle\Repository;

use OpenOrchestra\Pagination\MongoTrait\PaginationTrait;
use OpenOrchestra\Repository\AbstractAggregateRepository;
use OpenOrchestra\WorkflowFunction\Repository\WorkflowFunctionRepositoryInterface;
use OpenOrchestra\ModelInterface\Model\RoleInterface;

/**
 * Class WorkflowFunctionRepository
 */
class WorkflowFunctionRepository extends AbstractAggregateRepository implements WorkflowFunctionRepositoryInterface
{
    use PaginationTrait;

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function findAllWorkflowFunction()
    {
        $qb = $this->createQueryBuilder();

        return $qb->getQuery()->execute();
    }

    /**
     * @param RoleInterface $role
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function findByRole(RoleInterface $role)
    {
        $qb = $this->createQueryBuilder();
        $qb->field('roles.id')->equals($role->getId());

        return $qb->getQuery()->execute();
    }
}
