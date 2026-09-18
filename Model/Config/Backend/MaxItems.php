<?php

declare(strict_types=1);

namespace Doit\Announcement\Model\Config\Backend;

use Magento\Framework\App\Config\Value;
use Magento\Framework\Exception\LocalizedException;

class MaxItems extends Value
{
    public function beforeSave(): self
    {
        $value = $this->getValue();

        if (!is_numeric($value) || (int) $value <= 0) {
            throw new LocalizedException(
                __('Maximum Announcements must be greater than zero.')
            );
        }

        return parent::beforeSave();
    }
}
