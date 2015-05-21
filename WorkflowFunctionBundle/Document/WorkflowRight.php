<?php

namespace OpenOrchestra\WorkflowFunctionBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use OpenOrchestra\WorkflowFunction\Model\WorkflowRightInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use OpenOrchestra\WorkflowFunction\Model\AuthorizationInterface;

/**
 * Class WorkflowRight
 *
 * @ODM\Document(
 *   collection="workflow_right",
 *   repositoryClass="OpenOrchestra\WorkflowFunctionBundle\Repository\WorkflowRightRepository"
 * )
 */
class WorkflowRight implements WorkflowRightInterface
{
    /**
     * @var UserInterface $user
     *
     * @ODM\ReferenceOne(targetDocument="Symfony\Component\Security\Core\User\UserInterface")
     */
    protected $user;

    /**
     * @var ArrayCollection $authorizations
     *
     * @ODM\EmbedMany(targetDocument="OpenOrchestra\WorkflowFunction\Model\AuthorizationInterface")
     */
    protected $authorizations;

    /**
     * @var string $id
     *
     * @ODM\Id
     */
    protected $id;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->authorizations = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param UserInterface $user
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set authorizations
     *
     * @param ArrayCollection
     */
    public function setAuthorizations(ArrayCollection $authorizations)
    {
        $this->authorizations = $authorizations;
    }

    /**
     * Get authorizations
     *
     * @return ArrayCollection
     */
    public function getAuthorizations()
    {
        return $this->authorizations;
    }

    /**
     * Remove authorization
     *
     * @param AuthorizationInterface
     */
    public function removeAuthorization(AuthorizationInterface $authorization) {
        $this->authorizations->removeElement($authorization);
    }

    /**
     * Add authorization
     *
     * @param AuthorizationInterface
     */
    public function addAuthorization(AuthorizationInterface $authorization){
        $this->authorizations[] = $authorization;
    }

    /**
     * Clone the element
     */
    public function __clone()
    {
        $this->authorizations = new ArrayCollection();
    }
}
