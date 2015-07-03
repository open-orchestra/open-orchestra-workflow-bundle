<?php

namespace OpenOrchestra\WorkflowFunctionModelBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;
use OpenOrchestra\Pagination\MongoTrait\PaginateTrait;
use OpenOrchestra\WorkflowFunction\Repository\WorkflowFunctionRepositoryInterface;
use OpenOrchestra\ModelInterface\Model\RoleInterface;

/**
 * Class WorkflowFunctionRepository
 */
class WorkflowFunctionRepository extends DocumentRepository implements WorkflowFunctionRepositoryInterface
{
    use PaginateTrait;

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
