<?php

namespace OpenOrchestra\WorkflowFunctionModelBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Gedmo\Blameable\Traits\BlameableDocument;
use Gedmo\Timestampable\Traits\TimestampableDocument;
use Gedmo\Mapping\Annotation as Gedmo;
use OpenOrchestra\WorkflowFunction\Model\WorkflowFunctionInterface;
use OpenOrchestra\ModelInterface\Model\RoleInterface;
use OpenOrchestra\Mapping\Annotations as ORCHESTRA;

/**
 * Class WorkflowFunction
 *
 * @ODM\Document(
 *   collection="workflow_function",
 *   repositoryClass="OpenOrchestra\WorkflowFunctionModelBundle\Repository\WorkflowFunctionRepository"
 * )
 */
class WorkflowFunction implements WorkflowFunctionInterface
{
    use BlameableDocument;
    use TimestampableDocument;

    /**
     * @var string $id
     *
     * @ODM\Id
     */
    protected $id;

    /**
     * @var string $name
     *
     * @ODM\Field(type="string")
     * @ORCHESTRA\Search(key="name")
     */
    protected $name;

    /**
     * @var Collection
     *
     * @ODM\ReferenceMany(targetDocument="OpenOrchestra\ModelInterface\Model\RoleInterface")
     */
    protected $roles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->initCollections();
    }

    /**
     * Clone the element
     */
    public function __clone()
    {
        $this->initCollections();
    }

    protected function initCollections() {
        $this->roles = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return Collection
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param RoleInterface $role
     */
    public function addRole(RoleInterface $role)
    {
        $this->roles->add($role);
    }

    /**
     * @param RoleInterface $role
     */
    public function removeRole(RoleInterface $role)
    {
        $this->roles->remove($role);
    }
}
