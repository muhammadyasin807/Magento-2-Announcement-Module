<?php

declare(strict_types=1);

namespace Doit\Announcement\Model\ResourceModel\Announcement;
use Doit\Announcement\Model\Announcement;
use Doit\Announcement\Model\ResourceModel\Announcement as AnnouncementResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected function _construct(): void
    {
        $this->_init(Announcement::class, AnnouncementResource::class);
    }

}
