<?php

namespace OpenOrchestra\WorkflowFunction\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use OpenOrchestra\WorkflowFunction\Model\AuthorizationInterface;

/**
 * Interface WorkflowRightInterface
 */
interface WorkflowRightInterface
{
    const NODE = 'node';

    /**
     * @return string
     */
    public function getId();

    /**
     * @param string $userId
     */
    public function setUserId($userId);

    /**
     * @return string
     */
    public function getUserId();

    /**
     * @param ArrayCollection
     */
    public function setAuthorizations(ArrayCollection $authorizations);

    /**
     * @return ArrayCollection
     */
    public function getAuthorizations();

    /**
     * @param AuthorizationInterface
     */
    public function removeAuthorization(AuthorizationInterface $authorization);

    /**
     * @param AuthorizationInterface
     */
    public function addAuthorization(AuthorizationInterface $authorization);
}
