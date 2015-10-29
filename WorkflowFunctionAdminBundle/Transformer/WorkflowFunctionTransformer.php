<?php

namespace OpenOrchestra\WorkflowFunctionAdminBundle\Transformer;

use OpenOrchestra\BaseApi\Facade\FacadeInterface;
use OpenOrchestra\BaseApi\Transformer\AbstractSecurityCheckerAwareTransformer;
use OpenOrchestra\WorkflowFunctionAdminBundle\Facade\WorkflowFunctionFacade;
use OpenOrchestra\WorkflowFunction\Model\WorkflowFunctionInterface;
use OpenOrchestra\Backoffice\Manager\TranslationChoiceManager;
use OpenOrchestra\WorkflowFunctionAdminBundle\NavigationPanel\Strategies\WorkflowFunctionPanelStrategy;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class WorkflowFunctionTransformer
 */
class WorkflowFunctionTransformer extends AbstractSecurityCheckerAwareTransformer
{
    protected $translationChoiceManager;

    /**
     * @param TranslationChoiceManager $translationChoiceManager
     */
    public function __construct(TranslationChoiceManager $translationChoiceManager, AuthorizationCheckerInterface $authorizationChecker)
    {
        parent::__construct($authorizationChecker);
        $this->translationChoiceManager = $translationChoiceManager;
    }

    /**
     * @param WorkflowFunctionInterface $mixed
     *
     * @return FacadeInterface
     */
    public function transform($mixed)
    {
        $facade = new WorkflowFunctionFacade();

        $facade->id = $mixed->getId();
        $facade->name = $this->translationChoiceManager->choose($mixed->getNames());

        $facade->addLink('_self', $this->generateRoute(
            'open_orchestra_api_workflow_function_show',
            array('workflowFunctionId' => $mixed->getId())
        ));
        if ($this->authorizationChecker->isGranted(WorkflowFunctionPanelStrategy::ROLE_ACCESS_DELETE_WORKFLOWFUNCTION)) {
            $facade->addLink('_self_delete', $this->generateRoute(
                'open_orchestra_api_workflow_function_delete',
                array('workflowFunctionId' => $mixed->getId())
            ));
        }
        if ($this->authorizationChecker->isGranted(WorkflowFunctionPanelStrategy::ROLE_ACCESS_UPDATE_WORKFLOWFUNCTION)) {
            $facade->addLink('_self_form', $this->generateRoute(
                'open_orchestra_backoffice_workflow_function_form',
                array('workflowFunctionId' => $mixed->getId())
            ));
        }

        return $facade;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'workflow_function';
    }
}
