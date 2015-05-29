<?php

namespace OpenOrchestra\WorkflowFunctionBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;
use OpenOrchestra\WorkflowFunction\Repository\WorkflowFunctionRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use OpenOrchestra\ModelInterface\Model\RoleInterface;

/**
 * Class WorkflowFunctionRepository
 */
class WorkflowFunctionRepository extends DocumentRepository implements WorkflowFunctionRepositoryInterface
{
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
}
