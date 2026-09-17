<?php
declare(strict_types=1);

namespace Doit\Announcement\Block\Adminhtml;
use Magento\Backend\Block\Template;

class Announcement extends Template
{

    public function getPageHeading(): string
    {
        return (string)__('Announcement Management');
    }

}

