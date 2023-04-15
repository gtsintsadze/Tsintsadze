<?php

namespace Tsintsadze\Minerva\Controller\Adminhtml\Faq;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Setup\Exception;
use Tsintsadze\Minerva\Model\Faq;
use Tsintsadze\Minerva\Model\FaqFactory;
use Tsintsadze\Minerva\Model\ResourceModel\Faq as FaqResource;

class InlineEdit extends Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = "Tsintsadze_Minerva::faq_save";

    protected JsonFactory $jsonFactory;

    protected FaqFactory $faqFactory;

    protected FaqResource $faqResource;

    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        FaqFactory $faqFactory,
        FaqResource $faqResource
    )
    {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->faqFactory = $faqFactory;
        $this->faqResource = $faqResource;

    }

    public function execute()
    {
        $json = $this->jsonFactory->create();
        $messages = [];
        $error = false;
        $isAjax = $this->getRequest()->getParam("isAjax", false);
        $items = $this->getRequest()->getParam("items", []);

        if (!$isAjax || !count($items)) {
            $messages[] = __("Please correct this data sent.");
            $error = true;
        }

        if (!$error) {
            foreach ($items as $item) {
                $id = $item["id"];
                try {
                    $faq = $this->faqFactory->create();
                    $this->faqResource->load($faq, $id);
                    $faq->setData(array_merge($faq->getData(), $item));
                    $this->faqResource->save($faq);
                } catch (\Exception $e) {
                    $messages[] = __("Something went wrong while saving item $id");
                    $error = true;
                }
            }
        }

        return $json->setData([
            "messages" => $messages,
            "error" => $error,
        ]);
    }
}
