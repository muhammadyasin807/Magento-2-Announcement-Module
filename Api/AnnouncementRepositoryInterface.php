<?php
declare(strict_types=1);

namespace Doit\Announcement\Api;

use Doit\Announcement\Api\Data\AnnouncementInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Doit\Announcement\Api\Data\AnnouncementSearchResultsInterface;

interface AnnouncementRepositoryInterface
{
    public function getById(int $id): AnnouncementInterface;

    public function save(AnnouncementInterface $announcement): AnnouncementInterface;

    public function delete(AnnouncementInterface $announcement): bool;

    public function getList(SearchCriteriaInterface $searchCriteria): AnnouncementSearchResultsInterface;
}
