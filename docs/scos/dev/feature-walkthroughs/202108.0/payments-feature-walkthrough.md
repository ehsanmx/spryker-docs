---
title: Payments feature walkthrough
last_updated: Aug 18, 2021
description: The Payments feature allows customers to pay for orders with none, one, or multiple payment methods during the checkout process.
template: concept-topic-template
---

The _Payments_ feature allows customers to pay for orders with none, one, or multiple payment methods during the checkout process.


To learn more about the feature and to find out how end users use it, see [Payments feature overview](/docs/scos/dev/features/{{page.version}}/payments-feature-overview.html) for business users.


## Entity diagram

The following schema illustrates relations between the _Payment_, _PaymentGui_, and _PaymentDataImport_ modules:

<div class="width-100">

![payment-methods-modules-scheme.png](https://spryker.s3.eu-central-1.amazonaws.com/docs/Features/Payment/Payment+Methods+Overview/payment-methods-modules-scheme.png)

</div>


## Related Developer articles

| INTEGRATION GUIDES  | MIGRATION GUIDES | GLUE API GUIDES | DATA IMPORT | TUTORIALS AND HOWTOS | REFERENCES |
|---|---|---|---|---|---|
| [Payments feature integration](/docs/scos/dev/migration-and-integration/{{page.version}}/feature-integration-guides/payments-feature-integration.html) | Payment migration guide | [Updating payment data](/docs/scos/dev/glue-api-guides/{{page.version}}/checking-out/updating-payment-data.html) | [File details: payment_method.csv](/docs/scos/dev/developer-guides/{{page.version}}/development-guide/data-import/data-import-categories/commerce-setup/file-details-payment-method-store.csv.html) | [HowTo - Hydrate payment methods for an order](/docs/scos/dev/tutorials-and-howtos/{{page.version}}/howtos/howto-hydrate-payment-methods-for-an-order.html) | [Payment partners](/docs/scos/dev/technology-partners/{{page.version}}/payment-partners/adyen/adyen.html) <!-- must be a link to the whole directory payment-partnerts --> |
|  |  |  | [File details: payment_method_store.csv](/docs/scos/dev/developer-guides/{{page.version}}/development-guide/data-import/data-import-categories/commerce-setup/file-details-payment-method-store.csv.html) | [Implementing Direct Debit Payment](/docs/scos/dev/developer-guides/{{page.version}}/development-guide/back-end/data-manipulation/payment-methods/direct-debit-example-implementation/implementing-direct-debit-payment.html) |  |
|  |  |  |  | [Tutorial - Interacting with third party payment providers via Glue API](/docs/scos/dev/tutorials-and-howtos/{{page.version}}/advanced-tutorials/glue-api/tutorial-interacting-with-third-party-payment-providers-via-glue-api.html) |  |