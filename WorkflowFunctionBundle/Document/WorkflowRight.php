<?php

namespace OpenOrchestra\WorkflowFunctionBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use OpenOrchestra\WorkflowFunction\Model\WorkflowRightInterface;
use OpenOrchestra\WorkflowFunction\Model\AuthorizationInterface;
use OpenOrchestra\WorkflowFunctionBundle\MongoTrait\EmbeddedCollection;

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
    use EmbeddedCollection;

    /**
     * @var string $userId
     *
     * @ODM\Field(type="string")
     */
    protected $userId;

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
        $this->initCollections();
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
     * Set userId
     *
     * @param string $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Get userId
     *
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
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
    public function removeAuthorization(AuthorizationInterface $authorization)
    {
        $this->authorizations->removeElement($authorization);
    }

    /**
     * Add authorization
     *
     * @param AuthorizationInterface
     */
    public function addAuthorization(AuthorizationInterface $authorization)
    {
        $this->authorizations[] = $authorization;
    }

    /**
     * Clone the element
     */
    public function __clone()
    {
        $this->initCollections();
    }
}
