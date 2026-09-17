<?php
declare(strict_types=1);

namespace Doit\Announcement\Api\Data;

interface AnnouncementInterface
{
    public function getAnnouncementId(): ?int;
    public function setAnnouncementId(?int $announcementId): AnnouncementInterface;

    public function getTitle(): string;
    public function setTitle(string $title): AnnouncementInterface;

    public function getContent(): string;
    public function setContent(string $content): AnnouncementInterface;

    public function getStatus(): bool;
    public function setStatus(bool $status): AnnouncementInterface;
    public function getStartDate(): ?string;
    public function setStartDate(?string $startDate): AnnouncementInterface;
    public function getEndDate(): ?string;
    public function setEndDate(?string $endDate): AnnouncementInterface;

    public function getCreatedAt(): ?string;
    public function setCreatedAt(?string $createdAt): AnnouncementInterface;

    public function getUpdatedAt(): ?string;
    public function setUpdatedAt(?string $updatedAt): AnnouncementInterface;

    public function setSortOrder(int $sortOrder): AnnouncementInterface;
    public function getSortOrder(): int;

}
