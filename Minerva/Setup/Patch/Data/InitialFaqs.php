<?php

namespace Tsintsadze\Minerva\Setup\Patch\Data;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Tsintsadze\Minerva\Model\ResourceModel\Faq;

class InitialFaqs implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    protected ModuleDataSetupInterface $moduleDataSetup;

    /**
     * @var ResourceConnection
     */
    protected ResourceConnection $resource;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param ResourceConnection $resource
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        ResourceConnection $resource
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->resource = $resource;
    }


    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }

    public function apply(): self
    {
        $connection = $this->resource->getConnection();
        $data = [
            [
                "question" => "What is your best selling item?",
                "answer" => "The item you buy!",
                "is_published" => 1,
            ],
            [
                "question" => "what is your customer support number?",
                "answer" => "212-233-2442. ask for jenny!",
                "is_published" => 1,
            ],
            [
                "question" => "When will i get my order?",
                "answer" => "When it gets delivered, silly!",
                "is_published" => 0,
            ]
        ];
        $connection->insertMultiple(Faq::MAIN_TABLE, $data);

        return $this;
    }
}
