<?php

namespace OpenOrchestra\WorkflowFunctionModelBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OpenOrchestra\ModelInterface\DataFixtures\OrchestraFunctionalFixturesInterface;
use OpenOrchestra\WorkflowFunctionModelBundle\Document\WorkflowTransition;
use OpenOrchestra\WorkflowFunctionModelBundle\Document\WorkflowProfile;

/**
 * Class LoadWorkflowProfileDataFunctional
 */
class LoadWorkflowProfileDataFunctional extends AbstractFixture implements OrderedFixtureInterface,OrchestraFunctionalFixturesInterface
{
    /**
     * Load workflow profiles data fixtures
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
         $transitionDraftToPending = $this->createTransition('status-draft', 'status-pending');
         $transitionPendingToPublished = $this->createTransition('status-pending', 'status-published');
         $transitionPublishedToDraft = $this->createTransition('status-published', 'status-draft');

        $profileContributor = $this->createProfile('Contributor', array($transitionDraftToPending));
        $profileValidator = $this->createProfile('Validator', array($transitionPendingToPublished, $transitionPublishedToDraft));

        $manager->persist($profileContributor);
        $manager->persist($profileValidator);

        $manager->flush();
    }

    /**
     * @param string $statusFromReference
     * @param string $statusToReference
     *
     * @return WorkflowTransition $transition
     */
    protected function createTransition($statusFromReference, $statusToReference)
    {
        $transition = new WorkflowTransition();
        $transition->setStatusFrom($this->getReference($statusFromReference));
        $transition->setStatusTo($this->getReference($statusToReference));

        return $transition;
    }

    /**
     * @param string                    $label
     * @param array<WorkflowTransition> $transitions
     *
     * @return WorkflowProfile
     */
    protected function createProfile($label, array $transitions)
    {
        $profile = new WorkflowProfile($label);

        foreach ($transitions as $transition) {
            $profile->addTransition($transition);
        }

        return $profile;
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 150;
    }
}
