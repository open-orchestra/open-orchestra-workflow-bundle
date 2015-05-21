<?php

namespace OpenOrchestra\WorkflowFunctionBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;
use OpenOrchestra\WorkflowFunction\Repository\WorkflowRightRepositoryInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class WorkflowRightRepositoryInterface
 */
class WorkflowRightRepository extends DocumentRepository implements WorkflowRightRepositoryInterface
{
    /**
     * @param UserInterface $user
     *
     * @return WorkflowRightInterface
     */
    public function findOneByUser(UserInterface $user)
    {
        $qb = $this->createQueryBuilder();
        $qb->field('user.id')->equals($user->getId());

        return $qb->getQuery()->getSingleResult();
    }
}
