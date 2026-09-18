<?php

declare(strict_types=1);

namespace Doit\Announcement\Controller\Adminhtml\Announcement;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Forward;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;

class NewAction extends Action implements HttpGetActionInterface
{
    public const ADMIN_RESOURCE = 'Doit_Announcement::save';

    public function __construct(
        Context $context,
        private ForwardFactory $resultForwardFactory
    ) {
        parent::__construct($context);
    }

    public function execute(): Forward
    {
        $resultForward = $this->resultForwardFactory->create();

        return $resultForward->forward('edit');
    }
}
