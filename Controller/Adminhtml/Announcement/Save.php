<?php

declare(strict_types=1);

namespace Doit\Announcement\Controller\Adminhtml\Announcement;

use Doit\Announcement\Api\AnnouncementRepositoryInterface;
use Doit\Announcement\Model\AnnouncementFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
class Save extends Action implements HttpPostActionInterface
{
    public const ADMIN_RESOURCE = 'Doit_Announcement::save';
    private const DATA_PERSISTOR_KEY = 'doit_announcement';


    public function __construct(
        Context $context,
        private AnnouncementRepositoryInterface $announcementRepository,
        private AnnouncementFactory $announcementFactory,
        private LoggerInterface $logger,
        private DataPersistorInterface $dataPersistor
    ) {
        parent::__construct($context);
    }

    public function execute(): Redirect
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        $data = $this->getRequest()->getPostValue();

        if (!$data) {
            return $resultRedirect->setPath(
                'announcement/announcement/index'
            );
        }

        $id = isset($data['announcement_id'])
            ? (int) $data['announcement_id']
            : 0;

        try {
            if ($id > 0) {
                $announcement = $this->announcementRepository->getById($id);
            } else {
                $announcement = $this->announcementFactory->create();
            }

            $announcement->setTitle(
                (string) ($data['title'] ?? '')
            );

            $announcement->setContent(
                (string) ($data['content'] ?? '')
            );

            $announcement->setStatus(
                (bool) (int) ($data['status'] ?? 0)
            );

            $announcement->setStartDate(
                !empty($data['start_date'])
                    ? (string) $data['start_date']
                    : null
            );

            $announcement->setEndDate(
                !empty($data['end_date'])
                    ? (string) $data['end_date']
                    : null
            );

            $announcement->setSortOrder(
                (int) ($data['sort_order'] ?? 0)
            );

            $this->announcementRepository->save($announcement);

            $this->dataPersistor->clear(self::DATA_PERSISTOR_KEY);

            $this->messageManager->addSuccessMessage(
                __('The announcement has been saved.')
            );

            return $resultRedirect->setPath(
                'announcement/announcement/index'
            );
        } catch (LocalizedException $exception) {
            $this->dataPersistor->set(
                self::DATA_PERSISTOR_KEY,
                $data
            );
            $this->messageManager->addErrorMessage(
                $exception->getMessage()
            );
        } catch (\Throwable $exception) {
            $this->logger->critical($exception);

            $this->messageManager->addErrorMessage(
                __('Something went wrong while saving the announcement.')
            );
        }

        if ($id > 0) {
            return $resultRedirect->setPath(
                'announcement/announcement/edit',
                ['id' => $id]
            );
        }

        return $resultRedirect->setPath(
            'announcement/announcement/new'
        );
    }
}
