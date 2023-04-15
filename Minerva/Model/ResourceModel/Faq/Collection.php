<?php

namespace Tsintsadze\Minerva\Model\ResourceModel\Faq;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Tsintsadze\Minerva\Model\Faq;
use \Tsintsadze\Minerva\Model\ResourceModel\Faq as ResourceFaq;

class Collection extends AbstractCollection
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Faq::class, ResourceFaq::class);
    }
}
