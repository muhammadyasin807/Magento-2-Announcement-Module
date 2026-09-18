<?php

declare(strict_types=1);

namespace Doit\Announcement\Controller\Adminhtml\Announcement;

use Doit\Announcement\Api\AnnouncementRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface;

class Delete extends Action implements HttpGetActionInterface
{
    public const ADMIN_RESOURCE = 'Doit_Announcement::delete';

    public function __construct(
        Context $context,
        private readonly AnnouncementRepositoryInterface $announcementRepository,
        private readonly LoggerInterface $logger
    ) {
        parent::__construct($context);
    }

    public function execute(): Redirect
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        $id = (int) $this->getRequest()->getParam('id');

        if ($id <= 0) {
            $this->messageManager->addErrorMessage(
                __('We cannot find the announcement to delete.')
            );

            return $resultRedirect->setPath(
                'announcement/announcement/index'
            );
        }

        try {
            $announcement = $this->announcementRepository->getById($id);

            $this->announcementRepository->delete($announcement);

            $this->messageManager->addSuccessMessage(
                __('The announcement has been deleted.')
            );
        } catch (LocalizedException $exception) {
            $this->messageManager->addErrorMessage(
                $exception->getMessage()
            );
        } catch (\Throwable $exception) {
            $this->logger->critical($exception);

            $this->messageManager->addErrorMessage(
                __('Something went wrong while deleting the announcement.')
            );
        }

        return $resultRedirect->setPath(
            'announcement/announcement/index'
        );
    }
}
