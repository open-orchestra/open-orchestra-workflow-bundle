<?php

namespace OpenOrchestra\WorkflowFunction\Model;

use Doctrine\Common\Collections\Collection;
use OpenOrchestra\ModelInterface\Model\BlameableInterface;
use OpenOrchestra\ModelInterface\Model\TimestampableInterface;
use OpenOrchestra\ModelInterface\Model\RoleInterface;

/**
 * Interface WorkflowFunctionInterface
 */
interface WorkflowFunctionInterface extends TimestampableInterface, BlameableInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     */
    public function setName($name);

    /**
     * @return Collection
     */
    public function getRoles();

    /**
     * @param RoleInterface $role
     */
    public function addRole(RoleInterface $role);

    /**
     * @param RoleInterface $role
     */
    public function removeRole(RoleInterface $role);
}
