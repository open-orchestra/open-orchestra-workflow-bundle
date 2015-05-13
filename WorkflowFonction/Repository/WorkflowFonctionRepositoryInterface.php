<?php

namespace OpenOrchestra\WorkflowFonction\Repository;

use Doctrine\Common\Collections\Collection;
use OpenOrchestra\WorkflowFonction\Model\WorkflowFonctionInterface;

/**
 * Interface WorkflowFonctionRepositoryInterface
 */
interface WorkflowFonctionRepositoryInterface
{
    /**
     * @return Collection
     */
    public function findAllWorkflowFonction();

    /**
     * @param string $id
     *
     * @return mixed
     */
    public function find($id);
}
