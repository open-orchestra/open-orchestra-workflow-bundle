<?php

namespace OpenOrchestra\WorkflowFunctionBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;
use OpenOrchestra\WorkflowFunction\Repository\WorkflowRightRepositoryInterface;

/**
 * Class WorkflowRightRepositoryInterface
 */
class WorkflowRightRepository extends DocumentRepository implements WorkflowRightRepositoryInterface
{
    /**
     * @param string $userId
     *
     * @return WorkflowRightInterface
     */
    public function findOneByUserId($userId)
    {
        $qb = $this->createQueryBuilder();
        $qb->field('user.id')->equals($userId);

        return $qb->getQuery()->getSingleResult();
    }
}
