<?php

namespace OpenOrchestra\BackofficeBundle\Tests\Form\Type;

use OpenOrchestra\WorkflowFunctionAdminBundle\Form\Type\WorkflowFunctionType;
use Doctrine\Common\Collections\ArrayCollection;
use Phake;

/**
 * Description of WorkflowFunctionTypeTest
 */
class WorkflowFunctionTypeTest extends \PHPUnit_Framework_TestCase
{
    protected $workflowFunctionClass = 'fakeClass';
    protected $workflowFunctionType;
    protected $roleRepositoryInterface;
    protected $roles;

    /**
     * Set up the test
     */
    public function setUp()
    {
        $role1 = Phake::mock('OpenOrchestra\ModelInterface\Model\RoleInterface');
        $role2 = Phake::mock('OpenOrchestra\ModelInterface\Model\RoleInterface');

        $this->roles = new ArrayCollection();
        $this->roles->add($role1);
        $this->roles->add($role2);
        $this->roleRepositoryInterface = Phake::mock('OpenOrchestra\ModelInterface\Repository\RoleRepositoryInterface');
        Phake::when($this->roleRepositoryInterface)->findWorkflowRole()->thenReturn($this->roles);

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

        Phake::verify($formBuilderInterface)->add('name', 'text', array(
            'label' => 'open_orchestra_workflow_function_admin.form.workflow_function.name'
        ));
        Phake::verify($formBuilderInterface)->add('roles', 'document', array(
            'class' => 'OpenOrchestra\ModelBundle\Document\Role',
            'property' => 'name',
            'label' => 'open_orchestra_workflow_function_admin.form.workflow_function.role',
            'multiple' => true,
            'choices' => $this->roles,
        ));
    }

    /**
     * test Name
     */
    public function testGetName()
    {
        $this->assertEquals('workflow_function', $this->workflowFunctionType->getName());
    }
}
