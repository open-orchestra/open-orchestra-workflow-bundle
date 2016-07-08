<?php

namespace OpenOrchestra\WorkflowFunctionAdminBundle\Security\Authorization\Voter;

use OpenOrchestra\UserBundle\Model\UserInterface;
use OpenOrchestra\WorkflowFunction\Model\WorkflowFunctionInterface;
use OpenOrchestra\WorkflowFunction\Repository\WorkflowRightRepositoryInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * Class WorkflowFunctionVoter
 */
class WorkflowFunctionVoter extends Voter
{
    const DELETE = 'delete';

    protected $workflowRightRepository;

    /**
     * @param WorkflowRightRepositoryInterface $workflowRightRepository
     */
    public function __construct(WorkflowRightRepositoryInterface $workflowRightRepository)
    {
        $this->workflowRightRepository = $workflowRightRepository;
    }

    /**
     * @param string $attribute
     * @param mixed  $subject
     *
     * @return bool
     */
    protected function supports($attribute, $subject)
    {
        if (self::DELETE !== $attribute) {
            return false;
        }

        if (!$subject instanceof WorkflowFunctionInterface) {
            return false;
        }

        return true;
    }

    /**
     * @param string         $attribute
     * @param mixed          $subject
     * @param TokenInterface $token
     *
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        if (!$user instanceof UserInterface) {
            return false;
        }

        return $this->canDelete($subject);
    }

    /**
     * @param WorkflowFunctionInterface $workflowFunction
     *
     * @return bool
     */
    protected function canDelete(WorkflowFunctionInterface $workflowFunction)
    {
        return !$this->workflowRightRepository->hasElementWithWorkflowFunction($workflowFunction);
    }
}
