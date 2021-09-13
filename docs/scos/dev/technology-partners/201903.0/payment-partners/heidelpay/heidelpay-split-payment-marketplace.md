---
title: Heidelpay - Split-payment Marketplace
description: Integrate Split payment Marketplace through Heidelpay into the Spryker-based shop.
originalLink: https://documentation.spryker.com/v2/docs/heidelpay-split-payment-marketplace
originalArticleId: 3dbd7223-265a-41a5-b0a1-7c14ac70f84b
redirect_from:
  - /v2/docs/heidelpay-split-payment-marketplace
  - /v2/docs/en/heidelpay-split-payment-marketplace
---

## Setup

The following configuration should be made after Heidelpay has been [installed](/docs/scos/dev/technology-partners/201903.0/payment-partners/heidelpay/heidelpay-installation.html) and [integrated](/docs/scos/dev/technology-partners/201903.0/payment-partners/heidelpay/scos-integration/heidelpay-configuration-for-scos.html).

## Configuration

Example:
```php
// Heidelpay Split-payment marketplace logic
$config[HeidelpayConstants::CONFIG_IS_SPLIT_PAYMENT_ENABLED_KEY] = true;
```

## Project Implementation

A project level should set quote items and expenses information the field Heidelpay Item Channel Id. It could be done [using cart expander plugin](https://documentation.spryker.com/v2/docscart-functionality#cart-expanders).

Example:
```php
$quoteItem->setHeidelpayItemChannelId('........');
```