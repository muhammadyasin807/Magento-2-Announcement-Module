<?php

declare(strict_types=1);

namespace Doit\Announcement\Ui\DataProvider\Announcement\Form;

use Doit\Announcement\Model\ResourceModel\Announcement\CollectionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Framework\App\Request\DataPersistorInterface;

class DataProvider extends AbstractDataProvider
{
    private array $loadedData = [];

    private string $primaryField;

    private string $requestField;

    public function __construct(
        string                                  $name,
        string                                  $primaryFieldName,
        string                                  $requestFieldName,
        CollectionFactory                       $collectionFactory,
        private readonly RequestInterface       $request,
        private readonly DataPersistorInterface $dataPersistor,
        array                                   $meta = [],
        array                                   $data = []
    )
    {
        $this->collection = $collectionFactory->create();

        $this->primaryField = $primaryFieldName;
        $this->requestField = $requestFieldName;

        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );
    }

    public function getData(): array
    {
        if ($this->loadedData !== []) {
            return $this->loadedData;
        }

        $id = (int)$this->request->getParam(
            $this->requestField
        );

        if ($id > 0) {
            $this->collection->addFieldToFilter(
                $this->primaryField,
                $id
            );

            $announcement = $this->collection->getFirstItem();

            if ($announcement->getId()) {
                $this->loadedData[(int)$announcement->getId()] = $announcement->getData();
            }
        }

        $persistedData = $this->dataPersistor->get(
            'doit_announcement'
        );

        if (!empty($persistedData)) {
            $announcement = $this->collection->getNewEmptyItem();

            $announcement->setData($persistedData);

            $this->loadedData[$announcement->getId()] = $announcement->getData();

            $this->dataPersistor->clear(
                'doit_announcement'
            );
        }

        return $this->loadedData;
    }
}
