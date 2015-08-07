<?php

namespace OpenOrchestra\WorkflowFunctionModelBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OpenOrchestra\WorkflowFunction\Model\WorkflowRightInterface;
use OpenOrchestra\WorkflowFunctionModelBundle\Document\Authorization;
use OpenOrchestra\WorkflowFunctionModelBundle\Document\WorkflowRight;

/**
 * Class LoadWorkflowRightData
 */
class LoadWorkflowRightData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $workflowRight = new WorkflowRight();
        $workflowRight->setUserId($this->getReference('user-admin')->getId());

        $authorization = new Authorization();
        $authorization->setReferenceId(WorkflowRightInterface::NODE);
        $authorization->addWorkflowFunction($this->getReference('workflow_function-validator'));
        $authorization->addWorkflowFunction($this->getReference('workflow_function-contributor'));

        $workflowRight->addAuthorization($authorization);

        $manager->persist($workflowRight);
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1000;
    }
}
