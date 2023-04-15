<?php

namespace Tsintsadze\JsReq\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class Message implements ArgumentInterface
{
    public function getMessage()
    {
        return str_shuffle("Declarative Test");
    }
}
