<?php
declare(strict_types=1);

namespace Doit\Announcement\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Announcement extends AbstractDb
{
    protected function _construct(): void
    {
        $this->_init('doit_announcement', 'announcement_id');
    }
}
