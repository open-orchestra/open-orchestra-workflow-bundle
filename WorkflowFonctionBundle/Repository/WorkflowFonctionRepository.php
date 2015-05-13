<?php

namespace OpenOrchestra\WorkflowFonctionBundle\Repository;

use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\DocumentRepository;
use OpenOrchestra\WorkflowFonction\Model\WorkflowFonctionInterface;
use OpenOrchestra\WorkflowFonction\Repository\WorkflowFonctionRepositoryInterface;

/**
 * Class WorkflowFonctionRepository
 */
class WorkflowFonctionRepository extends DocumentRepository implements WorkflowFonctionRepositoryInterface
{
    /**
     * @return Collection
     */
    public function findAllWorkflowFonction()
    {
        $qb = $this->createQueryBuilder('w');
        return $qb->getQuery()->execute();
    }
}
