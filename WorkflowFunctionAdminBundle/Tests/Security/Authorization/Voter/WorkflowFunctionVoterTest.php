<?php

namespace OpenOrchestra\WorkflowFunctionAdminBundle\Tests\Security\Authorization\Voter;

use OpenOrchestra\BaseBundle\Tests\AbstractTest\AbstractBaseTestCase;
use OpenOrchestra\WorkflowFunctionAdminBundle\Security\Authorization\Voter\WorkflowFunctionVoter;
use Phake;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

/**
 * Test WorkflowFunctionVoterTest
 */
class WorkflowFunctionVoterTest extends AbstractBaseTestCase
{
    protected $workflowRightRepository;
    protected $contentTypeRepository;
    protected $token;
    protected $user;
    /**
     * @var WorkflowFunctionVoter
     */
    protected $voter;

    /**
     * Set up the test
     */
    public function setUp()
    {
        $this->workflowRightRepository = Phake::mock('OpenOrchestra\WorkflowFunction\Repository\WorkflowRightRepositoryInterface');
        $this->user = Phake::mock('OpenOrchestra\UserBundle\Document\User');
        $this->token = Phake::mock('Symfony\Component\Security\Core\Authentication\Token\TokenInterface');
        Phake::when($this->token)->getUser()->thenReturn($this->user);

        $this->voter = new WorkflowFunctionVoter($this->workflowRightRepository);
    }

    /**
     * Test instance
     */
    public function testInstance()
    {
        $this->assertInstanceOf('Symfony\Component\Security\Core\Authorization\Voter\Voter', $this->voter);
    }

    /**
     * @param int    $accessResponse
     * @param array  $attributes
     * @param mixed  $object
     * @param bool   $hasElement
     *
     * @dataProvider provideObject
     */
    public function testVote($accessResponse, array $attributes, $object, $hasElement)
    {
        Phake::when($this->workflowRightRepository)->hasElementWithWorkflowFunction(Phake::anyParameters())->thenReturn($hasElement);

        $this->assertEquals($accessResponse, $this->voter->vote($this->token, $object, $attributes));
    }

    /**
     * @return array
     */
    public function provideObject()
    {
        $workflowFunction = Phake::mock('OpenOrchestra\WorkflowFunction\Model\WorkflowFunctionInterface');
        $workflowRight = Phake::mock('OpenOrchestra\WorkflowFunction\Model\WorkflowRightInterface');

        return array(
            array(VoterInterface::ACCESS_ABSTAIN, array(), null, false),
            array(VoterInterface::ACCESS_ABSTAIN, array('edit'), null, false),
            array(VoterInterface::ACCESS_ABSTAIN, array('delete'), $workflowRight, false),
            array(VoterInterface::ACCESS_GRANTED, array('delete'), $workflowFunction, false),
            array(VoterInterface::ACCESS_GRANTED, array('delete'), $workflowFunction, false),
        );
    }
}
