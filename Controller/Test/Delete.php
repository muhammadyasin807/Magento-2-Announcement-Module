<?php
declare(strict_types=1);

namespace Doit\Announcement\Controller\Test;


use Doit\Announcement\Model\AnnouncementRepository;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\Raw;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\RawFactory;

class Delete implements HttpGetActionInterface
{
    /**
     * Index constructor.
     *
     * @param PageFactory $pageFactory
     */
    public function __construct(
        private AnnouncementRepository $announcementRepository,
        private readonly PageFactory $pageFactory,
    ) {
    }

    /**
     * Execute a controller action.
     *
     * @return Page
     */
    public function execute(): Raw
    {
        $announcement = $this->announcementRepository->getById(2);

        $this->announcementRepository->delete($announcement);

        echo 'Announcement deleted successfully.';
        exit;
    }
}
