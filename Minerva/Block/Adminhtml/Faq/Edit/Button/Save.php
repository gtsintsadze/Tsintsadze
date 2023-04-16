<?php

namespace Tsintsadze\Minerva\Block\Adminhtml\Faq\Edit\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Save implements ButtonProviderInterface
{

    public function getButtonData(): array
    {
        return [
            "label" => __("Save"),
            "class" => "save primary",
            "data_attribute" => [
                "mage-init" => [
                    "button" => [
                        "event" => "save",
                    ],
                ],
            ],
        ];
    }
}
