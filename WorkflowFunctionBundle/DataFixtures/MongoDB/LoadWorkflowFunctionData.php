<?php

namespace OpenOrchestra\WorkflowFunctionBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OpenOrchestra\WorkflowFunctionBundle\Document\WorkflowFunction;

/**
 * Class LoadWorkflowFunctionData
 */
class LoadWorkflowFunctionData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $workflowFunction = new WorkflowFunction();
        $workflowFunction->setName('Validator');
        $workflowFunction->addRole($this->getReference('role-published'));
        $manager->persist($workflowFunction);
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
