---
title: Klarna - Invoice Pay in 14 days
description: In this article, you will find invoice pay scenarios for the payment process with Klarna.
last_updated: Dec 26, 2019
template: concept-topic-template
originalLink: https://documentation.spryker.com/v4/docs/klarna-invoice-pay-in-14-days
originalArticleId: efd122c3-dc07-4b1b-875d-f515f8e6e9e8
redirect_from:
  - /v4/docs/klarna-invoice-pay-in-14-days
  - /v4/docs/en/klarna-invoice-pay-in-14-days
related:
  - title: Klarna
    link: docs/scos/user/technology-partners/page.version/payment-partners/klarna/klarna.html
  - title: Klarna - Payment Workflow
    link: docs/scos/user/technology-partners/page.version/payment-partners/klarna/technical-details-and-howtos/klarna-payment-workflow.html
  - title: Klarna - Part Payment Flexible
    link: docs/scos/user/technology-partners/page.version/payment-partners/klarna/technical-details-and-howtos/klarna-part-payment-flexible.html
  - title: Klarna - State Machine Commands and Conditions
    link: docs/scos/user/technology-partners/page.version/payment-partners/klarna/technical-details-and-howtos/klarna-state-machine-commands-and-conditions.html
---

## Payment Workflow Scenarios
![Click Me](https://spryker.s3.eu-central-1.amazonaws.com/docs/Technology+Partners/Payment+Partners/Klarna/invoice_paymentworkflow.png) 

## Cancel Workflow Scenarios
![Click Me](https://spryker.s3.eu-central-1.amazonaws.com/docs/Technology+Partners/Payment+Partners/Klarna/invoice_cancelworkflow.png) 

## Refund Workflow Scenarios
![Click Me](https://spryker.s3.eu-central-1.amazonaws.com/docs/Technology+Partners/Payment+Partners/Klarna/flexible_refundworkflow.png) 

## Integrating Klarna Part Payment
The configuration to integrate Part payment using Klarna is:

`SHARED_SECRET`: shared token.

`EID`: the id of the merchant, received from Klarna.

`TEST_MODE`: `true` or `false`.

`KLARNA_INVOICE_MAIL_TYPE`: type for user notification. Possible values are:

`KlarnaConstants::KLARNA_INVOICE_TYPE_MAIL`

`KlarnaConstants::KLARNA_INVOICE_TYPE_EMAIL`

`KlarnaConstants::KLARNA_INVOICE_TYPE_NOMAIL`

`KLARNA_PCLASS_STORE_TYPE`: pClasses storage type. Could be `json`, `xml`, `sql`. Default type is `json`.

`KLARNA_PCLASS_STORE_URI`: URI for pClasses storage. Default `APPLICATION_ROOT_DIR . '/data/DE/pclasses.json`'.

`KLARNA_CHECKOUT_CONFIRMATION_URI`: checkout confirmation URI, `default value $domain . '/checkout/klarna/success`'.

`KLARNA_CHECKOUT_TERMS_URI`: checkout terms URI, default value `$domain`.

`KLARNA_CHECKOUT_PUSH_URI`: checkout push URI, default value `$domain . '/checkout/klarna/push'`.

`KLARNA_CHECKOUT_UR`I: checkout URI, default value `$domain`.

`KLARNA_PDF_URL_PATTERN`: pdf URL pattern, default value `https://online.testdrive.klarna.com/invoices/%s.pdf`.

You can copy over configuration to your config from the Klarna modules `config.dist.php` file.

## Perform Requests

In order to perform the needed requests, you can easily use the implemented [Klarna State Machine Commands and Conditions](/docs/scos/dev/technology-partners/{{page.version}}/payment-partners/klarna/klarna-state-machine-commands-and-conditions.html). The next section gives a summary of them.
