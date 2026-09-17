<?php
declare(strict_types=1);

namespace Doit\Announcement\Model;

use Doit\Announcement\Api\AnnouncementRepositoryInterface;
use Doit\Announcement\Api\Data\AnnouncementInterface;
use Doit\Announcement\Api\Data\AnnouncementSearchResultsInterface;
use Doit\Announcement\Model\ResourceModel\Announcement as ResourceAnnouncement;
use Doit\Announcement\Model\ResourceModel\Announcement\CollectionFactory;
use Laminas\EventManager\EventManagerInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Event\ManagerInterface;

class AnnouncementRepository implements AnnouncementRepositoryInterface
{
    public function __construct(
        private AnnouncementFactory $announcementFactory,
        private ResourceAnnouncement $resourceAnnouncement,
        private AnnouncementSearchResultsFactory $announcementSearchResultsFactory,
        private CollectionProcessorInterface $collectionProcessor,
        private CollectionFactory $collectionFactory,
        private ManagerInterface $eventManager
    ) {
    }
    public function getById(int $id): AnnouncementInterface
    {
        $announcement = $this->announcementFactory->create();

        $this->resourceAnnouncement->load($announcement, $id);

        if (!$announcement->getAnnouncementId()) {
            throw new NoSuchEntityException(
                __('Announcement with ID "%1" does not exist.', $id)
            );
        }

        return $announcement;
    }

    public function save(AnnouncementInterface $announcement): AnnouncementInterface
    {
        try {
            $this->resourceAnnouncement->save($announcement);

        } catch (LocalizedException $exception) {
            throw new CouldNotSaveException(
                __('Could not save the announcement: %1', $exception->getMessage()),
                $exception
            );
        } catch (\Throwable $exception) {
            throw new CouldNotSaveException(
                __('Could not save the announcement. Something went wrong.'),
                $exception
            );
        }
        $this->eventManager->dispatch(
            'doit_announcement_saved',
            ['announcement' => $announcement]
        );
        return $announcement;
    }

    public function delete(AnnouncementInterface $announcement): bool
    {
        try {
            $this->resourceAnnouncement->delete($announcement);
        } catch (LocalizedException $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete the announcement: %1', $exception->getMessage()),
                $exception
            );
        } catch (\Throwable $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete the announcement. Something went wrong.'),
                $exception
            );
        }
        return true;
    }

    public function getList(SearchCriteriaInterface $searchCriteria): AnnouncementSearchResultsInterface
    {
        $collection = $this->collectionFactory->create();

        $this->collectionProcessor->process(
            $searchCriteria,
            $collection
        );

        $searchResults = $this->announcementSearchResultsFactory->create();

        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setSearchCriteria($searchCriteria);

        return $searchResults;
    }
}
