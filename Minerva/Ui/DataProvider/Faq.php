<?php

namespace Tsintsadze\Minerva\Ui\DataProvider;

use Tsintsadze\Minerva\Model\ResourceModel\Faq\Collection;
use Tsintsadze\Minerva\Model\ResourceModel\Faq\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

class Faq extends AbstractDataProvider
{

    /** @var Collection $collection */
    protected $collection;

    private array $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();

        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData(): array
    {
        if (!isset($this->loadedData)){
            $this->loadedData = [];

            foreach ($this->collection->getItems() as $item) {
                $this->loadedData[$item->getData("id")] = $item->getData();
            }
        }


        return $this->loadedData;
    }
}
