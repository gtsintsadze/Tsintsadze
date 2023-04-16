<?php

namespace Tsintsadze\Minerva\Controller\Adminhtml\Faq;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NotFoundException;
use Magento\Backend\App\Action\Context;
use Tsintsadze\Minerva\Model\FaqFactory;
use Tsintsadze\Minerva\Model\ResourceModel\Faq as FaqResource;
use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Backend\Model\View\Result\Redirect;

class Save extends Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = "Tsintsadze_Minerva::faq_save";

    private FaqFactory $faqFactory;

    private FaqResource $faqResource;

    /**
     * @param Context $context
     * @param FaqFactory $faqFactory
     * @param FaqResource $faqResource
     */
    public function __construct(
        Context $context,
        FaqFactory $faqFactory,
        FaqResource $faqResource

    ) {
        $this->faqFactory = $faqFactory;
        $this->faqResource = $faqResource;
        parent::__construct($context);
    }

    public function execute()
    {
        // Get the Post Data
        $post = $this->getRequest()->getPost();
        $isExistingPost = $post->id;

        $faq = $this->faqFactory->create();
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        // Determine if this is a new or existing record
        if ($isExistingPost) {
            try {
                // if existing, load data from database and merge with posted data
                $this->faqResource->load($faq, $post->id);
                // Not found? throw exception, display message
                if (!$faq->getData("id")) {
                    throw new NotFoundException(__("This Record No longer exists."));
                }
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $redirect->setPath("*/*/");
            }
        } else {
            // New Post
            // If new, build an object with the posted data to save it
            unset($post->id);
        }

        $faq->setData(array_merge($faq->getData(), $post->toArray()));

        // Save the data and display
        // if problem saving, display error message
        try {
            $this->faqResource->save($faq);
            $this->messageManager->addSuccessMessage(__("The record has been saved."));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__("there is a problem saving"));
            return $redirect->setPath("*/*/");
        }
        // On success, redirect
        return $redirect->setPath("*/*/");
    }
}
