<?php

namespace OpenOrchestra\Fonction\Event;

use OpenOrchestra\Fonction\Model\FonctionInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class FonctionEvent
 */
class FonctionEvent extends Event
{
    protected $fonction;

    /**
     * @param FonctionInterface $fonction
     */
    public function __construct(FonctionInterface $fonction)
    {
        $this->fonction = $fonction;
    }

    /**
     * @return FonctionInterface
     */
    public function getFonction()
    {
        return $this->fonction;
    }
}
