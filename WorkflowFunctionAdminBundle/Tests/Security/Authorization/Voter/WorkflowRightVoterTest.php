<?php

namespace OpenOrchestra\WorkflowFunctionAdminBundle\Tests\Security\Authorization\Voter;

use OpenOrchestra\WorkflowFunctionAdminBundle\Security\Authorization\Voter\WorkflowRightVoter;
use Phake;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use OpenOrchestra\WorkflowFunction\Model\WorkflowRightInterface;
use Doctrine\Common\Collections\ArrayCollection;
use OpenOrchestra\ModelInterface\Model\BlameableInterface;

/**
 * Test WorkflowRightVoterTest
 */
class WorkflowRightVoterTest extends \PHPUnit_Framework_TestCase
{
    protected $workflowRightRepository;
    protected $contentTypeRepository;
    protected $contentType = 'fakeContentType';
    protected $username = 'fakeUsername';
    protected $token;

    /**
     * @var WorkflowRightVoter
     */
    protected $voter;

    /**
     * Set up the test
     */
    public function setUp()
    {
        $contentType = Phake::mock('OpenOrchestra\ModelInterface\Model\ContentTypeInterface');
        Phake::when($contentType)->getId()->thenReturn($this->contentType);

        $this->contentTypeRepository = Phake::mock('OpenOrchestra\ModelInterface\Repository\ContentTypeRepositoryInterface');
        Phake::when($this->contentTypeRepository)->findOneByContentTypeIdInLastVersion(Phake::anyParameters())->thenReturn($contentType);

        $this->workflowRightRepository = Phake::mock('OpenOrchestra\WorkflowFunction\Repository\WorkflowRightRepositoryInterface');

        $user = Phake::mock('OpenOrchestra\UserBundle\Document\User');
        Phake::when($user)->getId()->thenReturn('fakeUserId');
        Phake::when($user)->getUsername()->thenReturn($this->username);

        $this->token = Phake::mock('Symfony\Component\Security\Core\Authentication\Token\TokenInterface');
        Phake::when($this->token)->getUser()->thenReturn($user);

        $this->voter = new WorkflowRightVoter($this->workflowRightRepository, $this->contentTypeRepository);

    }

    /**
     * Test instance
     */
    public function testInstance()
    {
        $this->assertInstanceOf('Symfony\Component\Security\Core\Authorization\Voter\VoterInterface', $this->voter);
    }

    /**
     * @param string  $class
     * @param boolean $isSupported
     *
     * @dataProvider provideClassName
     */
    public function testSupportsClass($class, $isSupported)
    {
        $this->assertEquals($isSupported, $this->voter->supportsClass($class));
    }

    /**
     * @return array
     */
    public function provideClassName()
    {
        return array(
            array(Phake::mock('OpenOrchestra\ModelInterface\Model\ContentTypeInterface'), false),
            array(Phake::mock('stdClass'), false),
            array(Phake::mock('OpenOrchestra\ModelInterface\Model\ContentInterface'), true),
            array(Phake::mock('OpenOrchestra\ModelInterface\Model\NodeInterface'), true)
        );
    }

    /**
     * @param string $attribute
     * @param bool   $supports
     *
     * @dataProvider provideAttributeAndSupport
     */
    public function testSupportsAttribute($attribute, $supports)
    {
        $this->assertSame($supports, $this->voter->supportsAttribute($attribute));
    }

    /**
     * @return array
     */
    public function provideAttributeAndSupport()
    {
        return array(
            array('test', true),
            array(array(), false)
        );
    }

    /**
     * @param mixed  $object
     * @param array  $arrayId
     * @param array  $attributes
     * @param string $accessResponse
     *
     * @dataProvider provideObject
     */
    public function testVote($object, $arrayId, $attributes, $accessResponse)
    {
        $workflowRight = Phake::mock('OpenOrchestra\WorkflowFunction\Model\WorkflowRightInterface');
        $authorizations = new ArrayCollection();
        foreach ($arrayId as $key => $value) {
            $authorization = Phake::mock('OpenOrchestra\WorkflowFunction\Model\AuthorizationInterface');
            $workflowFunctions = new ArrayCollection();
            foreach ($value as $subKey => $subValue) {
                $workflowFunction = Phake::mock('OpenOrchestra\WorkflowFunction\Model\WorkflowFunctionInterface');
                Phake::when($workflowFunction)->getId()->thenReturn($subValue);
                $workflowFunctions->add($workflowFunction);
            }
            Phake::when($authorization)->getWorkflowFunctions()->thenReturn($workflowFunctions);
            Phake::when($authorization)->getReferenceId()->thenReturn($key);
            Phake::when($authorization)->isOwner()->thenReturn(true);
            $authorizations->add($authorization);
        }
        Phake::when($workflowRight)->getAuthorizations()->thenReturn($authorizations);

        Phake::when($this->workflowRightRepository)->findOneByUserId('fakeUserId')->thenReturn($workflowRight);
        $this->assertEquals($accessResponse, $this->voter->vote($this->token, $object, $attributes));
    }

    /**
     * @return array
     */
    public function provideObject()
    {
        $object0 = Phake::mock('OpenOrchestra\ModelInterface\Model\ContentInterface');
        Phake::when($object0)->getContentType()->thenReturn($this->contentType);
        Phake::when($object0)->getCreatedBy()->thenReturn($this->username);
        $object1 = Phake::mock('OpenOrchestra\ModelInterface\Model\ContentInterface');
        Phake::when($object1)->getContentType()->thenReturn($this->contentType);
        Phake::when($object1)->getCreatedBy()->thenReturn($this->username);

        $object2 = Phake::mock('OpenOrchestra\ModelInterface\Model\NodeInterface');
        Phake::when($object2)->getCreatedBy()->thenReturn($this->username);
        $object3 = Phake::mock('OpenOrchestra\ModelInterface\Model\NodeInterface');
        Phake::when($object3)->getCreatedBy()->thenReturn($this->username);
        $object4 = Phake::mock('OpenOrchestra\ModelInterface\Model\NodeInterface');
        Phake::when($object4)->getCreatedBy()->thenReturn('fakeOtherUsername');

        $object5 = Phake::mock('OpenOrchestra\ModelInterface\Model\StatusableInterface');

        $workflowRight0 = array(
            $this->contentType => array('fakeFunctionId0', 'fakeFunctionId1'),
            WorkflowRightInterface::NODE => array()
        );
        $attributes0 = array('fakeFunctionId0');

        $workflowRight1 = array(
            $this->contentType => array('fakeFunctionId0', 'fakeFunctionId1'),
            WorkflowRightInterface::NODE => array()
        );
        $attributes1 = array('notFakeFunctionId0');

        $workflowRight2 = array(
            $this->contentType => array(),
            WorkflowRightInterface::NODE => array('fakeFunctionId0', 'fakeFunctionId1'),
        );
        $attributes2 = array('fakeFunctionId0');

        $workflowRight3 = array(
            $this->contentType => array(),
            WorkflowRightInterface::NODE => array('fakeFunctionId0', 'fakeFunctionId1'),
        );
        $attributes3 = array('notFakeFunctionId0');

        $workflowRight4 = array(
            $this->contentType => array(),
            WorkflowRightInterface::NODE => array('fakeFunctionId0', 'fakeFunctionId1'),
        );
        $attributes4 = array('fakeFunctionId0');

        $workflowRight5 = array(
            $this->contentType => array(),
            WorkflowRightInterface::NODE => array('fakeFunctionId0', 'fakeFunctionId1'),
        );
        $attributes5 = array('fakeFunctionId0');

        return array(
            array(Phake::mock('stdClass'), array(), array(), VoterInterface::ACCESS_ABSTAIN),
            array($object0, $workflowRight0, $attributes0, VoterInterface::ACCESS_GRANTED),
            array($object1, $workflowRight1, $attributes1, VoterInterface::ACCESS_DENIED),
            array($object2, $workflowRight2, $attributes2, VoterInterface::ACCESS_GRANTED),
            array($object3, $workflowRight3, $attributes3, VoterInterface::ACCESS_DENIED),
            array($object4, $workflowRight4, $attributes4, VoterInterface::ACCESS_DENIED),
            array($object5, $workflowRight5, $attributes5, VoterInterface::ACCESS_DENIED),
        );
    }
}
