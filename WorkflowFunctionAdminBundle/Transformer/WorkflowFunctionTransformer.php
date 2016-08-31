<?php

namespace OpenOrchestra\WorkflowFunctionAdminBundle\Transformer;

use OpenOrchestra\Backoffice\Manager\MultiLanguagesChoiceManagerInterface;
use OpenOrchestra\BaseApi\Facade\FacadeInterface;
use OpenOrchestra\BaseApi\Transformer\AbstractSecurityCheckerAwareTransformer;
use OpenOrchestra\WorkflowFunction\Model\WorkflowFunctionInterface;
use OpenOrchestra\WorkflowFunctionAdminBundle\NavigationPanel\Strategies\WorkflowFunctionPanelStrategy;
use OpenOrchestra\WorkflowFunctionAdminBundle\Security\Authorization\Voter\WorkflowFunctionVoter;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class WorkflowFunctionTransformer
 */
class WorkflowFunctionTransformer extends AbstractSecurityCheckerAwareTransformer
{
    protected $multiLanguagesChoiceManager;

    /**
     * @param string                               $facadeClass
     * @param MultiLanguagesChoiceManagerInterface $multiLanguagesChoiceManager
     * @param AuthorizationCheckerInterface        $authorizationChecker
     */
    public function __construct(
        $facadeClass,
        MultiLanguagesChoiceManagerInterface $multiLanguagesChoiceManager,
        AuthorizationCheckerInterface $authorizationChecker
    ){
        parent::__construct($facadeClass, $authorizationChecker);
        $this->multiLanguagesChoiceManager = $multiLanguagesChoiceManager;
    }

    /**
     * @param WorkflowFunctionInterface $mixed
     *
     * @return FacadeInterface
     */
    public function transform($mixed)
    {
        $facade = $this->newFacade();

        $facade->id = $mixed->getId();
        $facade->name = $this->multiLanguagesChoiceManager->choose($mixed->getNames());

        $facade->addLink('_self', $this->generateRoute(
            'open_orchestra_api_workflow_function_show',
            array('workflowFunctionId' => $mixed->getId())
        ));

        if ($this->authorizationChecker->isGranted(array(WorkflowFunctionPanelStrategy::ROLE_ACCESS_DELETE_WORKFLOWFUNCTION, WorkflowFunctionVoter::DELETE), $mixed)) {
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
