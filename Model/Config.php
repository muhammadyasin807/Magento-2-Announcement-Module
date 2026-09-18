<?php

declare(strict_types=1);

namespace Doit\Announcement\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{
    private const XML_PATH_ENABLED = 'doit_announcement/general/enabled';
    private const XML_PATH_MAX_ITEMS = 'doit_announcement/general/max_items';
    private const XML_PATH_DISPLAY_MODE = 'doit_announcement/general/display_mode';
    public const DISPLAY_MODE_LATEST = 'latest';
    public const DISPLAY_MODE_OLDEST = 'oldest';

    public function __construct(
        private readonly ScopeConfigInterface $scopeConfig
    ) {
    }

    public function isEnabled(?int $storeId = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_ENABLED,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
    public function getMaxItems(?int $storeId = null): int
    {
        return (int) $this->scopeConfig->getValue(
            self::XML_PATH_MAX_ITEMS,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function getDisplayMode(?int $storeId = null): string
    {
        return (string) $this->scopeConfig->getValue(
            self::XML_PATH_DISPLAY_MODE,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
}
