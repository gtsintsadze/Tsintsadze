<?php

namespace Tsintsadze\Minerva\Controller\Adminhtml\Faq;

use Magento\Framework\Controller\ResultFactory;
use Tsintsadze\Minerva\Model\Faq;
use Tsintsadze\Minerva\Model\FaqFactory;
use Tsintsadze\Minerva\Model\ResourceModel\Faq as FaqResource;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpGetActionInterface;

class Delete extends Action implements HttpGetActionInterface
{
    const ADMIN_RESOURCE = "Tsintsadze_Minerva::faq_delete";

    protected FaqFactory $faqFactory;

    protected FaqResource $faqResource;

    public function __construct(
        Context $context,
        FaqFactory $faqFactory,
        FaqResource $faqResource
    ) {
        $this->faqFactory = $faqFactory;
        $this->faqResource = $faqResource;
        parent::__construct($context);
    }

    public function execute(): Redirect
    {
        try {
            $id = $this->getRequest()->getParam("id");

            $faq = $this->faqFactory->create();
            $this->faqResource->load($faq, $id);

            if ($faq->getId()) {
                $this->faqResource->delete($faq);
                $this->messageManager->addSuccessMessage(__("The record has been deleted."));
            } else {
                $this->messageManager->addErrorMessage(__("the record does not exist."));
            }
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
        }

        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        return $redirect->setPath('*/*');
    }
}
