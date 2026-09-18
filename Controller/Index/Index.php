<?php


declare(strict_types=1);

namespace Doit\Announcement\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Doit\Announcement\Model\Config;

class Index implements HttpGetActionInterface
{
    /**
     * Index constructor.
     *
     * @param PageFactory $pageFactory
     */
    public function __construct(
        private readonly PageFactory $pageFactory,
        private readonly Config $config,
    ) {
    }

    /**
     * Execute a controller action.
     *
     * @return Page
     */
    public function execute(): Page
    {
        var_dump($this->config->isEnabled());
        var_dump($this->config->getMaxItems());
        var_dump($this->config->getDisplayMode());
        die;
        return $this->pageFactory->create();
    }
}
