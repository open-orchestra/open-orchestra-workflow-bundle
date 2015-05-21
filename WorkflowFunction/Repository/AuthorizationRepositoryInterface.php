<?php

namespace OpenOrchestra\WorkflowFunction\Repository;

use Doctrine\Common\Collections\Collection;

/**
 * Interface AuthorizationRepositoryInterface
 */
interface AuthorizationRepositoryInterface
{
    /**
     * @return Collection
     */
    public function findByUser($userMongoId);

    /**
     * @param string $id
     *
     * @return mixed
     */
    public function find($id);
}
