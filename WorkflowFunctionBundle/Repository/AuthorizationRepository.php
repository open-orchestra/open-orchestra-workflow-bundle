<?php

namespace OpenOrchestra\WorkflowFunctionBundle\Repository;

use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\DocumentRepository;
use OpenOrchestra\WorkflowFunction\Repository\AuthorizationRepositoryInterface;

/**
 * Class AuthorizationRepository
 */
class AuthorizationRepository extends DocumentRepository implements AuthorizationRepositoryInterface
{
    /**
     * @return Collection
     */
    public function findByUser($userMongoId)
    {
        $qb = $this->createQueryBuilder('a');

        return $qb->getQuery()->execute();
    }
}
