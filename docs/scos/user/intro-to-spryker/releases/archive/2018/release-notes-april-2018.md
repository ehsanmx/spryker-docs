---
title: Release Notes - April - 2018
last_updated: Jun 16, 2021
template: concept-topic-template
originalLink: https://documentation.spryker.com/2021080/docs/release-notes-april-2018
originalArticleId: 14f48749-eedf-473a-8f88-7baa45f428f2
redirect_from:
  - /2021080/docs/release-notes-april-2018
  - /2021080/docs/en/release-notes-april-2018
  - /docs/release-notes-april-2018
  - /docs/en/release-notes-april-2018
---

## Features
### Reorder
One of the biggest factors that influences customer loyalty and persuades them to repeatedly buy from your shop, is shopping convenience. In this release, we are introducing another feature that will make your customers' (and your) life easier: **reorder**. This feature allows customers to reorder their previous orders in one click. All your customers would need to do is go to  _Order History_ in their **Customer Account** and reorder either the entire order or individual items from it.
![Reorder](https://spryker.s3.eu-central-1.amazonaws.com/docs/About/Releases/Archive/Release+Notes+-+April+-+2018/reorder_view_orders.png)

![Reorder - View details](https://spryker.s3.eu-central-1.amazonaws.com/docs/About/Releases/Archive/Release+Notes+-+April+-+2018/reorder_order_details.png)

**Affected Modules**

| MAJOR | MINOR | PATCH |
| --- | --- | --- |
| n/a | <ul><li>[Cart 4.6.0](https://github.com/spryker/cart/releases/tag/4.6.0)</li><li>[ProductBundle 4.4.0](https://github.com/spryker/product-bundle/releases/tag/4.4.0)</li><li>[ZedRequest 3.4.0](https://github.com/spryker/zed-request/releases/tag/3.4.0)</li></ul> | <ul><li>[AvailabilityCartConnector 4.1.1](https://github.com/spryker/availability-cart-connector/releases/tag/4.1.1)</li><li>[Customer 7.7.1](https://github.com/spryker/customer/releases/tag/7.7.1)</li><li>[ProductOption 6.1.5](https://github.com/spryker/product-option/releases/tag/6.1.5)</li><li>[Sales 8.9.1](https://github.com/spryker/sales/releases/tag/8.9.1)</li><li>[Shipment 6.4.1](https://github.com/spryker/shipment/releases/tag/6.4.1)</li></ul> |

### Own Orders of Customers in the Administration Interface
At one point or another, a shop owner / administrator might want to get a list of all orders made by a specific customer. This information could be useful for various reasons: just to determine if a customer ever ordered from the shop, or to offer them a discount, or to run an order-driven or product-based promotional campaign. From now on, such a feature is available: we have added a new **Orders** section on the **Customer View** page which lists all the orders made by the customer, as well as general order information, such as creation date, order status, order value and number of items in the order. The detailed order information can be viewed from here as well.

**Affected Modules**

| MAJOR | MINOR | PATCH |
| --- | --- | --- |
| n/a | <ul><li>[Customer 7.6.0](https://github.com/spryker/customer/releases/tag/7.6.0)</li><li> [Sales 8.7.0](https://github.com/spryker/sales/releases/tag/8.7.0)</li></ul> | n/a |

<!--**Documentation**
<br>For module documentation see:
For store administration guides see: -->

## Improvements
### Checkout Shipment Pre-Check Plugin
There can be a situation when a customer places an order, selects a shipment method, and at the same time this shipment method gets deactivated by the shop administrator in the Administration Interface. To avoid placement of order with the shipment method that is no longer active, we have implemented an active shipment pre-check plugin. The plugin checks if the shipment method selected in the current order is active or not. If the shipment method is inactive, the customer will get an error message.

**Affected Modules**

| MAJOR | MINOR | PATCH |
| --- | --- | --- |
|[ShipmentCheckoutConnector 1.0.0](https://github.com/spryker/shipment-checkout-connector/releases/tag/1.0.0)  | [Shipment 6.4.0](https://github.com/spryker/shipment/releases/tag/6.4.0) | n/a |

<!-- Documentation:
For plugin documentation see: -->

**Migration Guides**
<br>To upgrade, follow the steps described below:

* Apply every minor and patch:

```bash
composer update "spryker/*"
```

* Once that is done, upgrade to the new module major and its dependencies:

```bash
composer require spryker/shipment-checkout-connector:"^1.0.0" --update-with-dependencies
```

### Country on the Order Details Page in the Administrator Interface
With this release, we have added Country to the _Addresses_ section on the **View Order** page in the Administration interface, so now shop administrators can view the country for both shipping and billing addresses of an order.

**Affected Modules**

| MAJOR | MINOR | PATCH |
| --- | --- | --- |
| n/a |  [Sales 8.8.0](https://github.com/spryker/sales/releases/tag/8.8.0)|  n/a|

### Extension Points for Post (De)activation of CMS Pages and Categories Update
With this release, we have implemented a post activate / deactivate hook for CMS pages. It also has a connector between CMS and Navigation and another one between Category and Navigation. This means that now a navigation node that represents a CMS page or a Category has an active / inactive status. Thus, for example, if a navigation node is deactivated in the Administration Interface, the categories will be updated, and the deactivated node will not be displayed in the web shop.

**Affected Modules**

| MAJOR | MINOR | PATCH |
| --- | --- | --- |
| <ul><li>[CategoryNavigationConnector 1.0.0](https://github.com/spryker/category-navigation-connector/releases/tag/1.0.0)</li><li>[CmsNavigationConnector 1.0.0](https://github.com/spryker/cms-navigation-connector/releases/tag/1.0.0)</li></ul> | <ul><li>[Category 4.4.0](https://github.com/spryker/category/releases/tag/4.4.0)</li><li>[Cms 6.5.0](https://github.com/spryker/cms/releases/tag/6.5.0)</li><li>[Navigation 2.3.0](https://github.com/spryker/navigation/releases/tag/2.3.0)</li></ul> | n/a |

<!-- Documentation
For plugin documentation see: -->

**Migration Guides**
<br>To upgrade, follow the steps described below:

* Apply every minor and patch:

```bash
composer update "spryker/*"
```

* Once that is done, upgrade to the new module major and its dependencies:

```bash
composer require spryker/category-navigation-connector:"^1.0.0" spryker/cms-navigation-connector:"^1.0.0" --update-with-dependencies
```

## Bugfixes
### Guest User Order Count
Previously, we had an issue with orders count for guest users: _All orders of the customer_ field on the **View Order** page in the Administration Interface showed count of orders for all guest users in the system. This has been fixed in this release: now the orders of guest users are not counted.

**Affected Modules**

| MAJOR | MINOR | PATCH |
| --- | --- | --- |
| n/a | n/a | [Sales 8.8.1](https://github.com/spryker/sales/releases/tag/8.8.1) |

### SKU Fixes
In this release, we have fixed the following issues with SKU generation:
* It is now possible to create SKUs like `FOO.BAR-BAZ_QUX`.
* Editing a product causes generation of a new SKU no longer.
* Fixed the error message displayed when using unacceptable characters in an SKU.

**Affected Modules**

| MAJOR | MINOR | PATCH |
| --- | --- | --- |
| n/a | n/a | <ul><li>[Product 6.0.1](https://github.com/spryker/product/releases/tag/6.0.1)</li><li>[ProductManagement 0.13.2](https://github.com/spryker/product-management/releases/tag/0.13.2)</li></ul> |

## Documentation Updates
The following content has been added to the Academy:

* [Entity Manager](/docs/scos/dev/back-end-development/zed/persistence-layer/entity-manager.html)
* [Repository](/docs/scos/dev/back-end-development/zed/persistence-layer/repository.html)
* [Payment Integration - Computop](/docs/scos/user/technology-partners/{{site.version}}/payment-partners/computop/computop.html)
* [Computop API](/docs/scos/user/technology-partners/201811.0/payment-partners/computop/technical-details-and-howtos/computop-api.html)
* [Computop - Credit Card](/docs/scos/user/technology-partners/201811.0/payment-partners/computop/computop-payment-methods/computop-credit-card.html)
* [Computop - Direct Debit](/docs/scos/user/technology-partners/201811.0/payment-partners/computop/computop-payment-methods/computop-direct-debit.html)
* [Computop - Easy Credit](/docs/scos/user/technology-partners/201811.0/payment-partners/computop/computop-payment-methods/computop-easy-credit.html)
* [Computop - iDeal](/docs/scos/user/technology-partners/201811.0/payment-partners/computop/computop-payment-methods/computop-ideal.html)
* [Computop - OMS](/docs/scos/user/technology-partners/201811.0/payment-partners/computop/technical-details-and-howtos/computop-oms.html)
* [Computop - Paydirekt](/docs/scos/user/technology-partners/201811.0/payment-partners/computop/computop-payment-methods/computop-paydirekt.html)
* [Computop - PayPal](/docs/scos/user/technology-partners/201811.0/payment-partners/computop/computop-payment-methods/computop-paypal.html)
* [Computop - Sofort](/docs/scos/user/technology-partners/201811.0/payment-partners/computop/computop-payment-methods/computop-sofort.html)

Your feedback would be highly appreciated. Please help us understand what you need from the Spryker Academy by filling out a very short [survey](https://docs.google.com/forms/d/1_vZg0lfqq24Qf9-fQhU50NgsEBy4eDqnDyx7gKz9Faw/edit).
