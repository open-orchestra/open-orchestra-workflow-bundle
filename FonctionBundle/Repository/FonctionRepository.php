<?php

namespace OpenOrchestra\FonctionBundle\Repository;

use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\DocumentRepository;
use OpenOrchestra\Fonction\Model\FonctionInterface;
use OpenOrchestra\Fonction\Repository\FonctionRepositoryInterface;

/**
 * Class FonctionRepository
 */
class FonctionRepository extends DocumentRepository implements FonctionRepositoryInterface
{
    /**
     * @return Collection
     */
    public function findAllFonction()
    {
        $qb = $this->createQueryBuilder('f');
        return $qb->getQuery()->execute();
    }
}
