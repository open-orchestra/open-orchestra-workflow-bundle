<?php

namespace OpenOrchestra\WorkflowFunction\Model;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Interface WorkflowRightInterface
 */
interface WorkflowRightInterface
{
    const NODE = 'open_orchestra_workflow_function.node';

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
     * @param ArrayCollection $authorizations
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
