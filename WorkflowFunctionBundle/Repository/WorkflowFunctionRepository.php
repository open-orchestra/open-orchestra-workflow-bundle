<?php

namespace OpenOrchestra\WorkflowFunctionBundle\Repository;

use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\DocumentRepository;
use OpenOrchestra\WorkflowFunction\Model\WorkflowFunctionInterface;
use OpenOrchestra\WorkflowFunction\Repository\WorkflowFunctionRepositoryInterface;

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
        $qb = $this->createQueryBuilder('w');
        return $qb->getQuery()->execute();
    }
}
