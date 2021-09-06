---
title: Tax feature overview
description: With the Tax feature you can define taxes for the items you sell.
originalLink: https://documentation.spryker.com/2021080/docs/tax-feature-overview
originalArticleId: 2ca980d2-d08b-4511-b26c-4cafa8624283
redirect_from:
  - /2021080/docs/tax-feature-overview
  - /2021080/docs/en/tax-feature-overview
  - /docs/tax-feature-overview
  - /docs/en/tax-feature-overview
---

The *Tax* feature allows you to define taxes for the items you sell. The feature is represented by two entities: tax rates and tax sets. 

The tax rate is the percentage of the sales price that buyer pays as a tax. In the default Spryker implementation, the tax rate is defined per country where the tax applies. See [Managing tax rates](https://documentation.spryker.com/2021080/docs/managing-tax-rates-sets#managing-tax-rates) for details on how to create and manage tax rates for countries in the Back Office.

The tax set is a set of tax rates. You can [define tax sets in the Back office](https://documentation.spryker.com/2021080/docs/managing-tax-rates-sets#managing-tax-sets) or[ import tax sets](/docs/scos/dev/developer-guides/{{page.version}}/development-guide/data-import/data-import-categories/commerce-setup/file-details-tax.csv.html) into your project.

Tax sets can be applied to abstract product, product option and shipment:


| ENTITY | INSTRUCTIONS ON DEFINING TAX SETS FOR THE ENTITY IN THE BACK OFFICE  | DETAILS ON THE IMPORT FILE TO IMPORT TAX SETS FOR THE ENTITY |
| --- | --- | --- |
| Abstract product | [Defining prices](/docs/scos/user/user-guides/{{page.version}}/back-office-user-guide/catalog/products/abstract-products/creating-abstract-products-and-product-bundles.html#defining-prices) | [File details: product_abstract.csv](/docs/scos/dev/developer-guides/{{page.version}}/development-guide/data-import/data-import-categories/catalog-setup/products/file-details-product-abstract.csv.html#file-details--product_abstract-csv) |
| Product option | [Creating a product option](/docs/scos/user/user-guides/{{page.version}}/back-office-user-guide/catalog/product-options/creating-a-product-option.html#creating-a-product-option) | [File details: product_option.csv](/docs/scos/dev/developer-guides/{{page.version}}/development-guide/data-import/data-import-categories/special-product-types/product-options/file-details-product-option.csv.html) |
| Shipment | [Creating a delivery method](/docs/scos/user/user-guides/{{page.version}}/back-office-user-guide/administration/delivery-methods/creating-and-managing-delivery-methods.html#creating-a-delivery-method) | [File details: shipment.csv](/docs/scos/dev/developer-guides/{{page.version}}/development-guide/data-import/data-import-categories/commerce-setup/file-details-shipment.csv.html) |

## Avalara system for automated tax compliance
You can integrate the third-party system Avalara to automatically apply tax rates that depend on such factors as location, product type, and shipping rules. 

{% info_block warningBox %}

Avalara is mostly meant for the USA.

{% endinfo_block %}

To use Avalara, you need to [set up the AvaTax platform](https://help.avalara.com/Avalara_AvaTax_Update/Set_up_AvaTax_Update) for your application and [integrate Avalara](/docs/scos/dev/technology-partners/{{page.version}}/taxes/avalara-tax-integration.html) into your project. Once you do that, you can [apply Avalara tax codes](https://help.avalara.com/Avalara_AvaTax_Update/Avalara_tax_codes) to automate tax calculations for your shop.   

You can set the Avalara tax codes for the following entities by importing the codes:

* Abstract product: See [File details: product_abstract.csv](/docs/scos/dev/developer-guides/{{page.version}}/development-guide/data-import/data-import-categories/catalog-setup/products/file-details-product-abstract.csv.html) for details on import.
* Product option: See [File details: product_option.csv](/docs/scos/dev/developer-guides/{{page.version}}/development-guide/data-import/data-import-categories/special-product-types/product-options/file-details-product-option.csv.html) for details on import.
* Shipment: [See File details: shipment.csv](/docs/scos/dev/developer-guides/{{page.version}}/development-guide/data-import/data-import-categories/commerce-setup/file-details-shipment.csv.html) for details on import. 

{% info_block infoBox %}

Since shipment and products fall under different taxability categories, Avalara tax code for shipment is different from that of the abstract product or product option. See [Avalara tax code search](https://taxcode.avatax.avalara.com/) for details on the codes and categories.

{% endinfo_block %}

The Avalara codes are not displayed on the Storefront or in the Back Office. They are processed in the background to define taxes for order items. Avalara calculates taxes during the checkout, and, by default, the taxes are shown at the final checkout step.

When calculating taxes, Avalara takes the items' [warehouse addresses](/docs/scos/dev/features/{{page.version}}/inventory-management/inventory-management-feature-overview.html#defining-a-warehouse-address) into account. Therefore, each order item you calculate a tax for with Avalara, should have a warehouse assigned. See [Warehouse assignment](/docs/scos/dev/features/{{page.version}}/inventory-management/inventory-management-feature-overview.html#warehouse-assignment-to-order-items--with-avalara-integration-only-) to order items to learn how warehouses are assigned to order items by default.

## Tax feature on the Storefront

Product tax set is calculated when buyers add products to cart. Therefore, by default, the tax calculated on the basis of the product tax sets is displayed in the *Tax* section on the *Cart* page. However, the tax value on the *Cart* page is not always final, as it does not take a possible shipment tax set into account since buyers select the shipping method during the checkout. If you have Avalara integrated, it calculates tax during the checkout as well. Therefore, the final tax value is always displayed only upon checkout.

Tax on the *Cart* page:

![image](https://spryker.s3.eu-central-1.amazonaws.com/docs/Features/Tax/tax-in-cart.png)

Tax in the checkout:

![image](https://spryker.s3.eu-central-1.amazonaws.com/docs/Features/Tax/tax-in-checkout.png)

## Current constraints

Currently, the feature has the following functional constraints:

* There is no Back Office UI for the Avalara tax codes.
* Many Avalara features are not supported yet. This will be resolved in the future.

