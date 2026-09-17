<?php

declare(strict_types=1);

namespace Doit\Announcement\Model;

use Doit\Announcement\Api\Data\AnnouncementSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

class AnnouncementSearchResults extends SearchResults implements AnnouncementSearchResultsInterface
{

}
