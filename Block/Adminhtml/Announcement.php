<?php
declare(strict_types=1);

namespace Doit\Announcement\Block\Adminhtml;

use Doit\Announcement\Model\Config;
use Magento\Backend\Block\Template;
use Magento\Framework\View\Element\Template\Context;

class Announcement extends Template
{
    public function __construct(
        Context $context,
        private  Config $config,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function getPageHeading(): string
    {
        return (string)__('Announcement Management');
    }

    public function isEnabled(): bool
    {
        return $this->config->isEnabled();
    }
}

