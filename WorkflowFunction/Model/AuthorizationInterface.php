<?php

namespace OpenOrchestra\WorkflowFunction\Model;

use Doctrine\Common\Collections\ArrayCollection;
use OpenOrchestra\WorkflowFunction\Model\WorkflowFunctionInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Interface AuthorizationInterface
 */
interface AuthorizationInterface
{
    const NODE = 'node';
    /**
     * @param string $authorizationId
     */
    public function setAuthorizationId($authorizationId);

    /**
     * @return string
     */
    public function getAuthorizationId();

    /**
     * @param UserInterface $user
     */
    public function setUser(UserInterface $user);

    /**
     * @return UserInterface $user
     */
    public function getUser();

    /**
     * @param ArrayCollection $workflowFunctions
     */
    public function setWorkflowFunctions(ArrayCollection $workflowFunctions);

    /**
     * @return ArrayCollection
     */
    public function getWorkflowFunctions();
}
