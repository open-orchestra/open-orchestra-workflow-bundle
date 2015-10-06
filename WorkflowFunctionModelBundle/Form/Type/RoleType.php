<?php
namespace OpenOrchestra\WorkflowFunctionModelBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use OpenOrchestra\ModelInterface\Repository\RoleRepositoryInterface;

/**
 * class RoleType
 */
class RoleType extends AbstractType
{

    protected $roleClass;

    protected $roleRepositoryInterface;

    /**
     *
     * @param string $workflowFunctionClass            
     * @param RoleRepositoryInterface $roleRepositoryInterface            
     */
    public function __construct($roleClass, RoleRepositoryInterface $roleRepositoryInterface)
    {
        $this->roleClass = $roleClass;
        $this->roleRepositoryInterface = $roleRepositoryInterface;
    }

    /**
     *
     * @param OptionsResolver $resolver            
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'class' => $this->roleClass,
            'property' => 'name',
            'choices' => $this->getChoices()
        ));
    }

    /**
     * Returns roles list for workflow.
     */
    protected function getChoices()
    {
        return $this->roleRepositoryInterface->findWorkflowRole();
    }

    /**
     *
     * @return string
     */
    public function getParent()
    {
        return 'document';
    }

    /**
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return "role_choice";
    }
}

