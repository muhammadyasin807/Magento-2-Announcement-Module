# Doit Announcement

Magento 2 custom announcement management module built as part of my
Magento Solution Architect learning program.

## Features

- Declarative schema
- Service contracts
- Repository pattern
- SearchCriteria support
- Events and observers
- Admin ACL
- Admin menu
- Admin management interface

## Compatibility

- Magento Open Source 2.4.8
- PHP 8.2

## Installation

Place the module under:

app/code/Doit/Announcement

Then run:

php bin/magento module:enable Doit_Announcement
php bin/magento setup:upgrade
php bin/magento cache:clean
