<?php

namespace Tsintsadze\Minerva\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Faq extends AbstractDb
{
    /** @var string Main Table Name */
    const MAIN_TABLE = "tsintsadze_minerva_faq";
    /** @var string Main table primary key field name */
    const ID_FIELD_NAME = "id";

    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}
