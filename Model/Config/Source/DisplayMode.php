<?php

declare(strict_types=1);

namespace Doit\Announcement\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class DisplayMode implements OptionSourceInterface
{
    public function toOptionArray(): array
    {
        return [
            [
                'value' => 'latest',
                'label' => __('Latest First'),
            ],
            [
                'value' => 'oldest',
                'label' => __('Oldest First'),
            ],
        ];
    }
}
