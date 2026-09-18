<?php

declare(strict_types=1);

namespace Doit\Announcement\Ui\Component\Listing\Column;

use Magento\Backend\Model\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class AnnouncementActions extends Column
{
    private const URL_PATH_EDIT = 'announcement/announcement/edit';

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        private readonly UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        parent::__construct(
            $context,
            $uiComponentFactory,
            $components,
            $data
        );
    }

    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if (!isset($item['announcement_id'])) {
                    continue;
                }

                $item[$this->getData('name')]['edit'] = [
                    'href' => $this->urlBuilder->getUrl(
                        self::URL_PATH_EDIT,
                        [
                            'id' => (int) $item['announcement_id'],
                        ]
                    ),
                    'label' => __('Edit'),
                ];

                $item[$this->getData('name')]['delete'] = [
                    'href' => $this->urlBuilder->getUrl(
                        'announcement/announcement/delete',
                        ['id' => $item['announcement_id']]
                    ),
                    'label' => __('Delete'),
                    'confirm' => [
                        'title' => __('Delete Announcement'),
                        'message' => __(
                            'Are you sure you want to delete this announcement?'
                        ),
                    ],
                ];
            }
        }

        return $dataSource;
    }
}
