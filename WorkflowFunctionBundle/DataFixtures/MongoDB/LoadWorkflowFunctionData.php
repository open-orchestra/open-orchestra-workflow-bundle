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
        $workflowFunctionValidator = new WorkflowFunction();
        $workflowFunctionValidator->setName('Validator');
        $workflowFunctionValidator->addRole($this->getReference('role-published'));

        $workflowFunctionContributor = new WorkflowFunction();
        $workflowFunctionContributor->setName('Contributor');
        $workflowFunctionContributor->addRole($this->getReference('role-draft'));

        $manager->persist($workflowFunctionValidator);
        $manager->persist($workflowFunctionContributor);
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
