<?php

namespace Tsintsadze\Minerva\Controller\Adminhtml\Faq;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Tsintsadze\Minerva\Model\ResourceModel\Faq\CollectionFactory;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Backend\Model\View\Result\Redirect;

class MassDelete extends Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = "Tsintsadze_Minerva::faq_delete";

    protected CollectionFactory $collectionFactory;

    protected Filter $filter;

    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        Filter $filter
    )
    {
        parent::__construct($context);
        $this->collectionFactory = $collectionFactory;
        $this->filter = $filter;
    }

    public function execute(): Redirect
    {
        $collection = $this->collectionFactory->create();
        $items = $this->filter->getCollection($collection);
        $itemSize = $items->getSize();

        foreach ($items as $item) {
            $item->delete();
        }

        $this->messageManager->addSuccessMessage(__("A total of %1 record(s) have bean Deleted", $itemSize));

        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        return $redirect->setPath("*/*");
    }
}
