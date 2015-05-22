<?php

namespace OpenOrchestra\WorkflowFunction\Model;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Interface ReferenceInterface
 */
interface ReferenceInterface
{
    /**
     * @param string $id
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getId();
}
