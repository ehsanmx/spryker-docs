---
title: Marketplace Product feature overview
description: This document contains concept information for the Marketplace Products feature.
template: concept-topic-template
---

In the Marketplace, products that a merchant owns, are referred to as *merchant products*. Besides creating offers for products of other merchants or the ones that the Marketplace administrator suggests, a merchant can also create their own unique products. These products possess the same characteristics the usual abstract and concrete products have, but in addition, every such product has merchant-related information such as merchant reference. Merchants can [create their products in the Merchant Portal]<!---LINK--> or [import the merchant products data](/docs/marketplace/dev/data-import/{{page.version}}/file-details-merchant-product.csv.html), or merchants manage stock and set prices for their products in the Merchant Portal. See Managing merchant products <!---LINK--> for details.

Merchants can allow other merchants to create offers for their unique products. This possibility is defined with the help of `is_shared` parameter of the [merchant product data importer](/docs/marketplace/dev/data-import/{{page.version}}/file-details-merchant-product.csv.html).

## Marketplace products on the Storefront

The marketplace products are displayed on the Storefront when the following conditions are met:

1. The product status is *Active*.
2. The merchant who owns the product is [*Active*](/docs/marketplace/user/back-office-user-guides/{{page.version}}/marketplace/merchants/managing-merchants.html#activating-and-deactivating-merchants).
3. The product visibility state is `Online`.
4. The product is defined for the current store.
5. The product has stock or is always in stock.
6. The current day is within the range of the product validity dates.

### Merchant product on the product details page

Marketplace product appears on top of the the *Sold by* list together with the product offers from other merchants. For a buyer, it doesn't matter whether they are buying a product offer or a merchant product, however in the system, different entities are defined.

Product price on top of the product details page is taken from the merchant product or the product offer. It depends on the option selected in the *Sold by* box.

![Merchant product on PDP](https://spryker.s3.eu-central-1.amazonaws.com/docs/Marketplace/user+guides/Features/Marketplace+product/merchant-product-on-pdp.png)

The marketplace product is also displayed with the *Sold By* field defining the merchant on the following pages:

- Cart page
- Wishlist
- Shipment page of the Checkout
- Summary page of the Checkout
- Order Details of the customer account

![Merchant product on PDP](https://spryker.s3.eu-central-1.amazonaws.com/docs/Marketplace/user+guides/Features/Marketplace+product/add-merchant-product-to-wl-and-from-wh-to-cart.gif)


### Searching and filtering marketplace products
When the merchant name is entered in the catalog search, not only the offers but also the products belonging to this merchant are displayed. By selecting a merchant name in the filter, products from this merchant are also displayed.

![Search for merchant products](https://spryker.s3.eu-central-1.amazonaws.com/docs/Marketplace/user+guides/Features/Marketplace+product/search-for-products-by-name-and-sku.gif)


## Marketplace products in the Back Office
Before new merchant products become visible on the Storefront, they must be activated either by the merchant <!---LINK--> in the Merchant Portal or [by the Marketplace administrator in the Back Office](/docs/marketplace/user/back-office-user-guides/{{page.version}}/catalog/products/managing-products/managing-products.html#activating-a-product).

A Marketplace administrator can filter the products belonging to certain merchants in the Back Office.

![merchants-switcher-on-products](https://spryker.s3.eu-central-1.amazonaws.com/docs/Marketplace/user+guides/Features/Marketplace+product/filter-merchant-productsby-merchant-back-office.gif)

Also, Marketplace administrators can edit products, if needed, and create products when acting as the [main merchant](/docs/marketplace/user/features/{{page.version}}/marketplace-merchant-feature-overview/main-merchant-concept.html).


## Marketplace products in the Merchant Portal
Merchants create and manage their products <!---LINK--> in the Merchant Portal. They can define prices, stock, attributes etc. for their products. See Managing merchant products <!---LINK--> for details on how to do that.

## Related Business User articles

| MERCHANT PORTAL USER GUIDES  | BACK OFFICE USER GUIDES |
| -------------------- | ----------------------- |
| Managing merchant products <!---LINK--> | [Editing abstract products](/docs/marketplace/user/back-office-user-guides/{{page.version}}/catalog/products/abstract-products/editing-abstract-products.html) |
| | [Editing a product variant](/docs/marketplace/user/back-office-user-guides/{{page.version}}/catalog/products/abstract-products/editing-abstract-products.html#editing-product-variants-of-an-abstract-product) |

{% info_block warningBox "Developer guides" %}

Are you a developer? See [Marketplace Products feature walkthrough](/docs/marketplace/dev/feature-walkthroughs/{{page.version}}/marketplace-product-feature-walkthrough.html) for developers.

{% endinfo_block %}
