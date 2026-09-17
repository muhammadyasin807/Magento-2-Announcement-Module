<?php

declare(strict_types=1);

namespace Doit\Announcement\Controller\Test;

use Doit\Announcement\Api\AnnouncementRepositoryInterface;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\Raw;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Doit\Announcement\Model\AnnouncementFactory;
use Magento\Framework\Controller\Result\RawFactory;

class Save implements HttpGetActionInterface
{
    /**
     * Index constructor.
     *
     * @param PageFactory $pageFactory
     */
    public function __construct(
        private AnnouncementFactory $announcementFactory,
        private AnnouncementRepositoryInterface $announcementRepository,
        private readonly PageFactory $pageFactory,
        private RawFactory $rawFactory
    ) {
    }


    public function execute(): Raw
    {
        $announcement = $this->announcementFactory->create();
        $announcement
            ->setTitle('  New Summer Sale  ')
            ->setContent('This is our test for event, observer 2.')
            ->setStatus(true)
            ->setSortOrder(0);
        $saveAnnouncement = $this->announcementRepository->save($announcement);

        $announcementId = $saveAnnouncement->getAnnouncementId();

        if ($announcementId === null) {
            throw new \RuntimeException('Announcement ID was not generated.');
        }

        $loadedAnnouncement = $this->announcementRepository->getById(
            $saveAnnouncement->getAnnouncementId()
        );


        $result = $this->rawFactory->create();
        $result->setContents($loadedAnnouncement->getTitle());

        return $result;
    }
}
