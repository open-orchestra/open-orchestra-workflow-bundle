<?php

namespace OpenOrchestra\WorkflowFunction\Repository;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Interface WorkflowFunctionRepositoryInterface
 */
interface WorkflowRightRepositoryInterface
{
    /**
     * @param UserInterface $user
     *
     * @return WorkflowRightInterface
     */
    public function findOneByUser(UserInterface $user);

    /**
     * @param string $id
     *
     * @return mixed
     */
    public function find($id);
}
