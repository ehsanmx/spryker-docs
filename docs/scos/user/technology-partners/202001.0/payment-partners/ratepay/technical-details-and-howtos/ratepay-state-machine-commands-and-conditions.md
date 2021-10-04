---
title: RatePay - State Machine Commands and Conditions
description: This article includes the state machine commands and conditions provided by Ratepay.
originalLink: https://documentation.spryker.com/v4/docs/ratepay-state-machine
originalArticleId: 3ab4cf12-b967-4f7a-b078-e30bd49c3a74
redirect_from:
  - /v4/docs/ratepay-state-machine
  - /v4/docs/en/ratepay-state-machine
---

## Commands

### ConfirmDelivery

* Send delivery confirmation data to RatePAY
* Response:
  - Success: Delivery confirmed
  - Declined: Request format error or delivery confirmation error
* Plugin: `ConfirmDeliveryPlugin`

### ConfirmPayment

* Send payment confirmation data to RatePAY
* Response:
  - Success: Payment confirmed
  - Declined: Request format error or payment confirmation error
* Plugin: `ConfirmPaymentPlugin`

### CancelPayment

* Send order items cancellation data to RatePAY
* Response:
  - Success: Order items canceled successfully
  - Declined: Request format error or order items cancellation error
* Plugin: `CancelPaymentPlugin`

### RefundPayment

* Send refund order items data to RatePAY
* Response:
  - Success: Order items refunded successfully
  - Declined: Request format error or order items refund error
* Plugin: `RefundPaymentPlugin`

## Conditions

| Name | Description | Plugin |
| --- | --- | --- |
| `IsRefunded` | Checks transaction status for successful order items refund response | `IsRefundedPlugin` |
| `IsPaymentConfirmed` | Checks transaction status for successful order items payment response | `IsPaymentConfirmedPlugin` |
| `IsDeliveryConfirmed` | Checks transaction status for successful order items delivery response | `IsDeliveryConfirmedPlugin` |
| `IsCancellationConfirmed` | Checks transaction status for successful order items cancellation response | `IsCancellationConfirmedPlugin` |
