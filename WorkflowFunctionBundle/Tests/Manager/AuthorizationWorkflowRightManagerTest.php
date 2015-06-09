<?php

namespace OpenOrchestra\WorkflowFunctionBundle\Tests\Manager;

use OpenOrchestra\WorkflowFunction\Manager\AuthorizationWorkflowRightManager;
use Doctrine\Common\Collections\ArrayCollection;
use Phake;

/**
 * Class AuthorizationWorkflowRightManagerTest
 */
class AuthorizationWorkflowRightManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AuthorizationWorkflowRightManager
     */
    protected $authorizationWorkflowRightManager;

    protected $authorizationClass = 'OpenOrchestra\WorkflowFunctionBundle\Document\Authorization';

    /**
     * Set up the test
     */
    public function setUp()
    {
        $this->authorizationWorkflowRightManager = new AuthorizationWorkflowRightManager($this->authorizationClass);
    }

    /**
     * @param array $inReference
     * @param array $inAuthorization
     * @param int   $nbrRemove
     * @param int   $nbrAdd
     *
     * @dataProvider provideWorkflowRight
     */
    public function testCleanAuthorization($inReference, $inAuthorization, $nbrRemove, $nbrAdd) {
        $workflowRight = Phake::mock('OpenOrchestra\WorkflowFunction\Model\WorkflowRightInterface');

        $authorizations = new ArrayCollection();
        foreach ($inAuthorization as $authorizationId) {
            $authorization[] = Phake::mock('OpenOrchestra\WorkflowFunction\Model\AuthorizationInterface');
            $index = count($authorization) - 1;
            Phake::when($authorization[$index])->getReferenceId()->thenReturn($authorizationId);
            $authorizations->add($authorization[$index]);
        }
        Phake::when($workflowRight)->getAuthorizations()->thenReturn($authorizations);

        $references = new ArrayCollection();
        foreach ($inReference as $referenceId) {
            $reference[] = Phake::mock('OpenOrchestra\WorkflowFunction\Model\ReferenceInterface');
            $index = count($reference) - 1;
            Phake::when($reference[$index])->getId()->thenReturn($referenceId);
            $references->add($reference[$index]);
        }

        $this->authorizationWorkflowRightManager->cleanAuthorization($references, $workflowRight);

        Phake::verify($workflowRight, Phake::times($nbrRemove))->removeAuthorization(Phake::anyParameters());
        Phake::verify($workflowRight, Phake::times($nbrAdd))->addAuthorization(Phake::anyParameters());
    }

    /**
     * @return array
     */
    public function provideWorkflowRight()
    {
        return array(
            array(array('fake_reference', 'fake_both'), array('fake_authorization', 'fake_both'), 1, 1),
            array(array('fake_reference'), array('fake_authorization'), 1, 1),
            array(array(), array('fake_authorization', 'fake_both'), 2, 0),
            array(array('fake_reference', 'fake_both'), array(), 0, 2),
        );
    }
}
