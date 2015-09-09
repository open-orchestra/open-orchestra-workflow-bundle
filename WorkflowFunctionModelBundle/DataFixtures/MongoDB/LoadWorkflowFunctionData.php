<?php

namespace OpenOrchestra\WorkflowFunctionBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OpenOrchestra\ModelInterface\DataFixtures\OrchestraProductionFixturesInterface;
use OpenOrchestra\WorkflowFunctionModelBundle\Document\WorkflowFunction;
use OpenOrchestra\ModelInterface\DataFixtures\OrchestraFunctionalFixturesInterface;

/**
 * Class LoadWorkflowFunctionData
 */
class LoadWorkflowFunctionData extends AbstractFixture implements OrderedFixtureInterface, OrchestraProductionFixturesInterface, OrchestraFunctionalFixturesInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $workflowFunctionValidator = new WorkflowFunction();
        $workflowFunctionValidator->setName('Validator');
        $workflowFunctionValidator->addRole($this->getReference('role-pending'));
        $workflowFunctionValidator->addRole($this->getReference('role-published'));
        $this->addReference('workflow_function-validator', $workflowFunctionValidator);

        $workflowFunctionContributor = new WorkflowFunction();
        $workflowFunctionContributor->setName('Contributor');
        $workflowFunctionContributor->addRole($this->getReference('role-draft'));
        $this->addReference('workflow_function-contributor', $workflowFunctionContributor);

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
