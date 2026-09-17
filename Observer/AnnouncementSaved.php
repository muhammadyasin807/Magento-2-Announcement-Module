<?php
declare(strict_types=1);

namespace Doit\Announcement\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

class AnnouncementSaved implements ObserverInterface
{
    public function __construct(
        private LoggerInterface $logger
    ) {

    }
    public function execute(Observer $observer):void
    {
        $announcement = $observer->getEvent()->getAnnouncement();

        $this->logger->info(
            'Announcement Saved: ' . $announcement->getTitle()
        );

    }

}
