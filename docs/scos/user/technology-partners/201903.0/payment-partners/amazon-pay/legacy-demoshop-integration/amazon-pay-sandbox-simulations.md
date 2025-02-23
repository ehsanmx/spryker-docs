---
title: Amazon Pay - Sandbox Simulations
description: In this article, you can get information about sandbox simulations for the Amazon Pay module in Spryker Legacy Demoshop.
last_updated: Nov 22, 2019
template: concept-topic-template
originalLink: https://documentation.spryker.com/v2/docs/amazon-pay-simulations-demoshop
originalArticleId: 70dbacf8-5b0c-4613-b638-a5b2d7259161
redirect_from:
  - /v2/docs/amazon-pay-simulations-demoshop
  - /v2/docs/en/amazon-pay-simulations-demoshop
related:
  - title: Amazon Pay - Obtaining an Amazon Order Reference and Information About Shipping Addresses
    link: docs/scos/user/technology-partners/page.version/payment-partners/amazon-pay/scos-integration/amazon-pay-obtaining-an-amazon-order-reference-and-information-about-shipping-addresses.html
  - title: Amazon Pay - Support of Bundled Products
    link: docs/scos/user/technology-partners/page.version/payment-partners/amazon-pay/legacy-demoshop-integration/amazon-pay-support-of-bundled-products.html
  - title: Amazon Pay - Refund
    link: docs/scos/user/technology-partners/page.version/payment-partners/amazon-pay/legacy-demoshop-integration/amazon-pay-refund.html
  - title: Amazon Pay - API
    link: docs/scos/user/technology-partners/page.version/payment-partners/amazon-pay/scos-integration/amazon-pay-api.html
  - title: Amazon Pay - Configuration for the SCOS
    link: docs/scos/user/technology-partners/page.version/payment-partners/amazon-pay/scos-integration/amazon-pay-configuration-for-the-scos.html
  - title: Amazon Pay - Rendering a “Pay with Amazon” Button on the Cart Page
    link: docs/scos/user/technology-partners/page.version/payment-partners/amazon-pay/legacy-demoshop-integration/amazon-pay-rendering-a-pay-with-amazon-button-on-the-cart-page.html
  - title: Amazon Pay - Sandbox Simulations
    link: docs/scos/user/technology-partners/page.version/payment-partners/amazon-pay/scos-integration/amazon-pay-sandbox-simulations.html
  - title: Amazon Pay - API
    link: docs/scos/user/technology-partners/page.version/payment-partners/amazon-pay/legacy-demoshop-integration/amazon-pay-api.html
  - title: Amazon Pay - Email Notifications
    link: docs/scos/user/technology-partners/page.version/payment-partners/amazon-pay/legacy-demoshop-integration/amazon-pay-email-notifications.html
  - title: Amazon Pay - Order Reference and Information about Shipping Addresses
    link: docs/scos/user/technology-partners/page.version/payment-partners/amazon-pay/legacy-demoshop-integration/amazon-pay-order-reference-and-information-about-shipping-addresses.html
---

In order to reproduce some edge cases like declined payment or pending capture, Amazon provides two solutions. The first is special methods marked with a red star on payment widget.

![Click Me](https://spryker.s3.eu-central-1.amazonaws.com/docs/Technology+Partners/Payment+Partners/Amazon+Pay/amazon_payment_widget.png)
It allows reproducing different cases of `decline` payment workflow.

But there are more edge cases like expired authorization or pending capture for which there is only one way to reproduce - pass simulation string as `SellerNote` parameter of API request.
