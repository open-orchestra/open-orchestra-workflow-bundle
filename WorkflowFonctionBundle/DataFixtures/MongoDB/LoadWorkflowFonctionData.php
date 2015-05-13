<?php

namespace OpenOrchestra\WorkflowFonctionBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OpenOrchestra\WorkflowFonctionBundle\Document\WorkflowFonction;

/**
 * Class LoadWorkflowFonctionData
 */
class LoadWorkflowFonctionData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $workflowFonction = new WorkflowFonction();
        $workflowFonction->setName('Validator');
        $workflowFonction->addRole($this->getReference('role-published'));
        $manager->persist($workflowFonction);
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
