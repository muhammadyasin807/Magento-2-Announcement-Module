<?php

declare(strict_types=1);

namespace Doit\Announcement\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
    public function toOptionArray(): array
    {
        return [
            [
                'value' => 1,
                'label' => __('Enabled'),
            ],
            [
                'value' => 0,
                'label' => __('Disabled'),
            ],
        ];
    }
}
