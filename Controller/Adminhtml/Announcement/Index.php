<?php

declare(strict_types=1);

namespace Doit\Announcement\Controller\Adminhtml\Announcement;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action implements HttpGetActionInterface
{
    public const ADMIN_RESOURCE = 'Doit_Announcement::manage';

    /**
     * Index constructor.
     *
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(
        Context $context,
        private PageFactory $pageFactory,
    ) {
        parent::__construct($context);
    }

    /**
     * Controller execution.
     *
     * @return Page
     */
    public function execute(): Page
    {
        $page = $this->pageFactory->create();

        $page->setActiveMenu('Doit_Announcement::manage');

        $page->getConfig()->getTitle()->prepend(__('Announcements'));

        return $page;
    }
}
