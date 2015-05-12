<?php

namespace OpenOrchestra\FonctionBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OpenOrchestra\FonctionBundle\Document\Fonction;

/**
 * Class LoadFonctionData
 */
class LoadFonctionData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $fonction = new Fonction();
        $fonction->setName('Validator');
        $fonction->addRole($this->getReference('role-published'));
        $manager->persist($fonction);
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 120;
    }

}
