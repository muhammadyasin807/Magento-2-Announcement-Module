<?php

declare(strict_types=1);

namespace Doit\Announcement\Controller\Adminhtml\Announcement;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action implements HttpGetActionInterface
{
    public const ADMIN_RESOURCE = 'Doit_Announcement::save';

    public function __construct(
        Context $context,
        private PageFactory $pageFactory
    ) {
        parent::__construct($context);
    }

    public function execute(): Page
    {
        $page = $this->pageFactory->create();

        $page->setActiveMenu('Doit_Announcement::manage');

        $page->getConfig()
            ->getTitle()
            ->prepend(__('Announcement'));

        return $page;
    }
}
