<?php

namespace OpenOrchestra\WorkflowFunctionAdminBundle\Tests\EventSubscriber;

use OpenOrchestra\WorkflowFunctionAdminBundle\EventSubscriber\AddWorkFlowLinkSubscriber;
use OpenOrchestra\UserAdminBundle\UserFacadeEvents;
use Phake;

/**
 * Class AddWorkFlowLinkSubscriberTest
 */
class AddWorkFlowLinkSubscriberTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AddWorkFlowLinkSubscriber
     */
    protected $subscriber;

    protected $router;
    protected $userFacadeEvent;
    protected $userFacade;
    protected $fakeRoot = 'fakeRoot';

    /**
     * Set up the test
     */
    public function setUp()
    {
        $this->router = Phake::mock('Symfony\Component\Routing\Generator\UrlGeneratorInterface');
        $this->userFacadeEvent = Phake::mock('OpenOrchestra\UserAdminBundle\Event\UserFacadeEvent');
        $this->userFacade = Phake::mock('OpenOrchestra\UserAdminBundle\Facade\UserFacade');

        Phake::when($this->userFacadeEvent)->getUserFacade()->thenReturn($this->userFacade);
        Phake::when($this->router)->generate(Phake::anyParameters())->thenReturn($this->fakeRoot);

        $this->subscriber = new AddWorkFlowLinkSubscriber($this->router);
    }

    /**
     * Test instance
     */
    public function testInstance()
    {
        $this->assertInstanceOf('Symfony\Component\EventDispatcher\EventSubscriberInterface', $this->subscriber);
    }

    /**
     * Test event subscribed
     */
    public function testEventSubscribed()
    {
        $this->assertArrayHasKey(UserFacadeEvents::POST_USER_TRANSFORMATION, $this->subscriber->getSubscribedEvents());
    }

    /**
     * Test postUserTransformation
     */
    public function testPostUserTransformation()
    {
        $this->subscriber->postUserTransformation($this->userFacadeEvent);
        Phake::verify($this->userFacade)->addLink('_self_panel_workflow_right', $this->fakeRoot);
    }
}
