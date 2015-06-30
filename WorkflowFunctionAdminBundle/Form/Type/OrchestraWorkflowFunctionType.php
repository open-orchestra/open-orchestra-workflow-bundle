<?php
namespace OpenOrchestra\WorkflowFunctionAdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class OrchestraWorkflowFunctionType
 */
class OrchestraWorkflowFunctionType extends AbstractType
{
    /**
     * @var string
     */
    private $workflowFunctionClass;

    /**
     * @param $workflowFunctionClass
     */
    public function __construct($workflowFunctionClass)
    {
        $this->workflowFunctionClass = $workflowFunctionClass;
    }

    /**
     * Configures the options for this type.
     *
     * @param OptionsResolver $resolver The resolver for the options.
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'multiple' => true,
                'expanded' => true,
                'required' => false,
                'class' => $this->workflowFunctionClass,
                'property' => 'name'
            )
        );
    }

    /**
     * Returns the name of the parent type.
     *
     * You can also return a type instance from this method, although doing so
     * is discouraged because it leads to a performance penalty. The support
     * for returning type instances may be dropped from future releases.
     *
     * @return string|null|FormTypeInterface The name of the parent type if any, null otherwise.
     */
    public function getParent()
    {
        return 'document';
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'orchestra_workflow_function';
    }
}
