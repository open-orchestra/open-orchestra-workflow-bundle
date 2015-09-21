<?php

namespace OpenOrchestra\BackofficeBundle\Tests\Form\Type;

use OpenOrchestra\WorkflowFunctionAdminBundle\Form\Type\WorkflowFunctionType;
use Phake;

/**
 * Description of WorkflowFunctionTypeTest
 */
class WorkflowFunctionTypeTest extends \PHPUnit_Framework_TestCase
{
    protected $workflowFunctionClass = 'fakeClass';
    protected $workflowFunctionType;
    protected $roleRepositoryInterface;

    /**
     * Set up the test
     */
    public function setUp()
    {
        $this->roleRepositoryInterface = Phake::mock('OpenOrchestra\ModelInterface\Repository\RoleRepositoryInterface');
        $this->workflowFunctionType = new WorkflowFunctionType($this->workflowFunctionClass, $this->roleRepositoryInterface);
    }

    /**
     * test default options
     */
    public function testSetDefaultOptions()
    {
        $resolverMock = Phake::mock('Symfony\Component\OptionsResolver\OptionsResolver');

        $this->workflowFunctionType->configureOptions($resolverMock);

        Phake::verify($resolverMock)->setDefaults(
            array('data_class' => $this->workflowFunctionClass)
        );
    }

    /**
     * test buildForm
     */
    public function testBuildForm()
    {
        $formBuilderInterface = Phake::mock('Symfony\Component\Form\FormBuilderInterface');

        $this->workflowFunctionType->buildForm($formBuilderInterface, array());

        Phake::verify($formBuilderInterface, Phake::times(2))->add(Phake::anyParameters());
    }

    /**
     * test Name
     */
    public function testGetName()
    {
        $this->assertEquals('workflow_function', $this->workflowFunctionType->getName());
    }
}
