---
title: Klarna - Payment Workflow
description: In this article, you will find part payment request flow with Klarna.
originalLink: https://documentation.spryker.com/v5/docs/klarna-payment-workflow
originalArticleId: 1e62cf24-f67c-431d-8975-0114b37fe9c5
redirect_from:
  - /v5/docs/klarna-payment-workflow
  - /v5/docs/en/klarna-payment-workflow
---

Both `Part Payment` and `Invoice` payment methods have the same request flow. It basically consists of the following steps:

* Pre-check: reserves the amount of the purchase
* Check order status: checks if the order status is `pending accepted`. If it's not, OMS waits for 2 hours and then calls again `KlarnaApi` to retrieve the status of the order. In case the status is `denied` the order is canceled.
* Capture payment: activates the reservation that corresponds to the given reference number
* Update payment: if activation fails, we need to update the reservation that corresponds to the given reference number
* Refund: performs a partial refund.
* Cancel: cancels a reservation.