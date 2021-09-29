---
title: Payments feature overview
description: Orders can be paid with none, one or multiple payment methods that can be selected during checkout. Offer multiple payment methods for a single order.
originalLink: https://documentation.spryker.com/v4/docs/multiple-payment-methods-per-order
originalArticleId: 73970707-86a5-4e19-a85a-54e20be9db9e
redirect_from:
  - /v4/docs/multiple-payment-methods-per-order
  - /v4/docs/en/multiple-payment-methods-per-order
  - /v4/docs/payment
  - /v4/docs/en/payment
  - /v4/docs/payment-provider-integration
  - /v4/docs/en/payment-provider-integration
  - /v4/docs/dummy-payment
  - /v4/docs/en/dummy-payment

---

The *Payments* feature allows your customers to pay for orders with none (for example, a [gift card](/docs/scos/user/features/{{page.version}}/gift-cards-feature-overview.html), one or multiple payment methods during the checkout process. Most orders are paid with a single payment method but in some cases, it may be useful to allow multiple payment methods. For instance, the customer may want to use two credit cards or a gift card in addition to a traditional payment method.

With different payment gateways, like Amazon Pay, PayPal and BS Payone, you can adapt to your customers' needs and define the availability of payment methods based on customer preferences and country-specific regulations.

To make it possible, your customers to select a payment method during the checkout, you should fulfill the following conditions:

* Make it active.
* Assign to specific stores.

This can be configured in the Back Office.

The Spryker Commerce OS offers integrations with several payment providers that can be used in the checkout and order management. Easily define the availability of a provider based on customer preferences and local regulations and specify the order the providers are displayed in during checkout.

## Payment providers

The Spryker Commerce OS supports integration of the following payment providers, which are our official partners:

* [Adyen](/docs/scos/dev/technology-partners/{{page.version}}/payment-partners/adyen/adyen.html)
* [AfterPay](/docs/scos/dev/technology-partners/{{page.version}}/payment-partners/afterpay/afterpay.html)
* [Amazon Pay](/docs/scos/dev/technology-partners/{{page.version}}/payment-partners/amazon-pay/amazon-pay.html)
* [Arvato](/docs/scos/dev/technology-partners/{{page.version}}/payment-partners/arvato/arvato.html)
* [Billie](/docs/scos/dev/technology-partners/{{page.version}}/payment-partners/billie.html)
* [Billpay](/docs/scos/dev/technology-partners/{{page.version}}/payment-partners/billpay/billpay.html)
* [Braintree](/docs/scos/dev/technology-partners/{{page.version}}/payment-partners/braintree/braintree.html)
* [BS Payone](/docs/scos/dev/technology-partners/{{page.version}}/payment-partners/bs-payone/bs-payone.html)
* [Computop](/docs/scos/dev/technology-partners/{{page.version}}/payment-partners/computop/computop.html)
* [CrefoPay](/docs/scos/dev/technology-partners/{{page.version}}/payment-partners/crefopay/crefopay.html)
* [Heidelpay](/docs/scos/dev/technology-partners/{{page.version}}/payment-partners/heidelpay/heidelpay.html)
* [Klarna](/docs/scos/dev/technology-partners/{{page.version}}/payment-partners/klarna/klarna.html)
* [Payolution](/docs/scos/dev/technology-partners/{{page.version}}/payment-partners/payolution/payolution.html)
* [Powerpay](/docs/scos/dev/technology-partners/{{page.version}}/payment-partners/powerpay.html)
* [Ratenkauf by Easycredit](/docs/scos/dev/technology-partners/{{page.version}}/payment-partners/ratenkauf-by-easycredit/ratenkauf-by-easycredit.html)
* [RatePay](/docs/scos/dev/technology-partners/{{page.version}}/payment-partners/ratepay/ratepay.html)

## Dummy payment

By default, Spryker provides the [DummyPayment](https://github.com/spryker/dummy-payment) module, which has Credit Card and Invoice payments implemented. You can use these implemented payment methods, or refer to the DummyPayment modulewhen implementing additional payment methods in your project.
For details on how a new payment method is implemeted, see the articles on [how to implement the Direct Debit payment method](/docs/scos/dev/back-end-development/zed/data-manipulation/payment-methods/direct-debit-example-implementation/implementing-direct-debit-payment.html). Based on the examples in these articles, you can implement other payment methods for your projects.

## Payment methods in the Back Office

In the Back Office, you can view all payment methods available in the shop application, make a payment method active (visible) or inactive (invisible) in the Payment step of the checkout process. In addition, you can define stores in which a payment method will be displayed. If changed, the payment methods will be updated in the checkout as well.

{% info_block warningBox "Note" %}
Keep in mind that prior to managing payment methods in the Back Office, first, you need to create them by [importing payment methods data using a .CSV file](/docs/scos/dev/data-import/{{page.version}}/data-import-categories/commerce-setup/file-details-payment-method.csv.html
{% endinfo_block %}.

![List of payment methods](https://spryker.s3.eu-central-1.amazonaws.com/docs/Features/Payment/Payment+Methods+Overview/payment-methods-list.png)

See [Managing Payment Methods](/docs/scos/user/user-guides/{{page.version}}/back-office-user-guide/administration/payment-methods/managing-payment-methods.html) to learn more on how to make a payment method available during the checkout and assign it to different stores.

<!-- Managing Payment Methods in the Back Office

Overview of the reference information when working with payment methods in the Back Office

HowTo - Import Payment Method Store Relation Data

Hydrating payment methods for an order

  -->

## Related Business User articles

|BACK OFFICE USER GUIDES|
|---|
| [Manage payment methods](/docs/scos/user/user-guides/{{page.version}}/back-office-user-guide/administration/payment-methods/managing-payment-methods.html)   |

{% info_block warningBox "Developer guides" %}

Are you a developer? See [Payments feature walkthrough](/docs/scos/dev/feature-walkthroughs/{{page.version}}/payments-feature-walkthrough.html) for developers.

{% endinfo_block %}