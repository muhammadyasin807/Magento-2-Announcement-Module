<?php declare(strict_types=1);

namespace Doit\Announcement\Model;

use Doit\Announcement\Api\Data\AnnouncementInterface;
use Magento\Framework\Model\AbstractModel;
use Doit\Announcement\Model\ResourceModel\Announcement as AnnouncementResource;

class Announcement extends AbstractModel implements AnnouncementInterface
{


    public const TITLE = 'title';
    public const CONTENT = 'content';
    public const STATUS = 'status';
    public const START_DATE = 'start_date';
    public const END_DATE = 'end_date';
    public const SORT_ORDER = 'sort_order';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected function _construct():void
    {
        $this->_init(AnnouncementResource::class);
    }
    public function setAnnouncementId(?int $announcementId): AnnouncementInterface
    {
        $this->setId($announcementId);
        return $this;
    }
    public function getAnnouncementId(): ?int
    {
        $announcementId = parent::getId();
        return $announcementId !== null ? (int) $announcementId : null;
    }

    public function setTitle(string $title): AnnouncementInterface
    {
        $this->setData(self::TITLE, $title);
        return $this;
    }

    public function getTitle(): string
    {
        return (string) $this->getData(self::TITLE);
    }

    public function setContent(string $content): AnnouncementInterface
    {
        $this->setData(self::CONTENT, $content);
        return $this;
    }

    public function getContent(): string
    {
        return (string) $this->getData(self::CONTENT);
    }

    public function setStatus(bool $status): AnnouncementInterface
    {
        $this->setData(self::STATUS, $status);
        return $this;
    }

    public function getStatus(): bool
    {
        return (bool) $this->getData(self::STATUS);
    }


    public function setStartDate(?string $startDate): AnnouncementInterface
    {
        $this->setData(self::START_DATE, $startDate);
        return $this;
    }

    public function getStartDate(): ?string
    {
        $value = $this->getData(self::START_DATE);

        return $value !== null ? (string) $value : null;
    }

    public function setEndDate(?string $endDate): AnnouncementInterface
    {
        $this->setData(self::END_DATE, $endDate);
        return $this;
    }

    public function getEndDate(): ?string
    {
        $value = $this->getData(self::END_DATE);
        return $value !== null ? (string) $value : null;
    }

    public function setUpdatedAt(?string $updatedAt): AnnouncementInterface
    {
        $this->setData(self::UPDATED_AT, $updatedAt);
        return $this;
    }

    public function getUpdatedAt(): ?string
    {
        $value = $this->getData(self::UPDATED_AT);
        return $value !== null ? (string) $value : null;
    }

    public function setCreatedAt(?string $createdAt): AnnouncementInterface
    {
        $this->setData(self::CREATED_AT, $createdAt);
        return $this;
    }

    public function getCreatedAt(): ?string
    {
        $value = $this->getData(self::CREATED_AT);
        return $value !== null ? (string) $value : null;
    }

    public function setSortOrder(int $sortOrder): AnnouncementInterface
    {
        $this->setData(self::SORT_ORDER, $sortOrder);
        return $this;
    }
    public function getSortOrder(): int
    {
        return (int) $this->getData(self::SORT_ORDER);

    }

}
