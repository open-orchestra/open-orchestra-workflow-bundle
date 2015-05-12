<?php

namespace OpenOrchestra\Fonction\Repository;

use Doctrine\Common\Collections\Collection;
use OpenOrchestra\Fonction\Model\FonctionInterface;

/**
 * Interface FonctionRepositoryInterface
 */
interface FonctionRepositoryInterface
{
    /**
     * @return Collection
     */
    public function findAllFonction();

    /**
     * @param string $id
     *
     * @return mixed
     */
    public function find($id);
}
