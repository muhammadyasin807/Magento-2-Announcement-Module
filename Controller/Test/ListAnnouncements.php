<?php

declare(strict_types=1);

namespace Doit\Announcement\Controller\Test;

use Doit\Announcement\Api\AnnouncementRepositoryInterface;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\FilterGroupBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\Raw;
use Magento\Framework\Controller\Result\RawFactory;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Api\SortOrder;
class ListAnnouncements implements HttpGetActionInterface
{
    /**
     * Index constructor.
     *
     * @param PageFactory $pageFactory
     */
    public function __construct(
        private AnnouncementRepositoryInterface $announcementRepository,
        private SearchCriteriaBuilder $searchCriteriaBuilder,
        private FilterBuilder $filterBuilder,
        private FilterGroupBuilder $filterGroupBuilder,
        private readonly PageFactory $pageFactory,
        private SortOrderBuilder $sortOrderBuilder,
        private RawFactory $rawFactory
    ) {
    }

    /**
     * Execute a controller action.
     *
     * @return Page
     */
    public function execute(): Raw
    {
        /*$statusFilter = $this->filterBuilder
            ->setField('status')
            ->setValue(1)
            ->setConditionType('eq')
            ->create();

        $titleFilter = $this->filterBuilder
            ->setField('title')
            ->setValue('%Test%')
            ->setConditionType('like')
            ->create();*/
        $statusFilter = $this->filterBuilder
            ->setField('status')
            ->setValue(1)
            ->setConditionType('eq')
            ->create();

        $titleTestFilter = $this->filterBuilder
            ->setField('title')
            ->setValue('%Test%')
            ->setConditionType('like')
            ->create();

        $titleSaleFilter = $this->filterBuilder
            ->setField('title')
            ->setValue('%Sale%')
            ->setConditionType('like')
            ->create();
        $statusGroup = $this->filterGroupBuilder
            ->setFilters([
                $statusFilter
            ])
            ->create();

        $titleGroup = $this->filterGroupBuilder
            ->setFilters([
                $titleTestFilter,
                $titleSaleFilter
            ])
            ->create();
        $sortOrder = $this->sortOrderBuilder
            ->setField('sort_order')
            ->setDirection(SortOrder::SORT_DESC)
            ->create();
        /*$filterGroup = $this->filterGroupBuilder
            ->setFilters([
                $statusFilter,
                $titleFilter
            ])
            ->create();*/
        /*$searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('status', 1, 'eq')
            ->addFilter('title', '%Test%', 'like')
            ->create();*/

        /*$searchCriteria = $this->searchCriteriaBuilder
            ->setFilterGroups([$filterGroup])
            ->create();

        $searchCriteria = $this->searchCriteriaBuilder
            ->setFilterGroups([$statusGroup, $titleGroup])
            ->create();*/
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('status', 1, 'eq')
            ->addSortOrder($sortOrder)
            ->setPageSize(2)
            ->setCurrentPage(1)
            ->create();
        $searchResults = $this->announcementRepository->getList(
            $searchCriteria
        );
        $announcements = $searchResults->getItems();
        $output = '';

        echo 'Total: ' . $searchResults->getTotalCount() . '<br><br>';

        foreach ($searchResults->getItems() as $announcement) {
            echo $announcement->getTitle()
                . ' | Sort Order: '
                . $announcement->getSortOrder()
                . '<br>';
        }

        exit;
        $result = $this->rawFactory->create();
        $result->setContents($output);

        return $result;
        //return $this->pageFactory->create();
    }
}
