---
title: Glue API- Product Relations Feature Integration
description: This guide will navigate you through the process of installing and configuring the Product Relations feature in Spryker OS.
originalLink: https://documentation.spryker.com/v4/docs/glue-api-product-relations-feature-integration
originalArticleId: 78ce6883-dc51-4435-9454-f8ce791e74f5
redirect_from:
  - /v4/docs/glue-api-product-relations-feature-integration
  - /v4/docs/en/glue-api-product-relations-feature-integration
---

## Install Feature API
Follow the steps to install the Product Relations feature API.

### Prerequisites
To start feature integration, overview and install the necessary features:

|Name|Version|Required Sub-Feature|
|---|---|---|
|Spryker Core|202001.0|[Glue Application](https://documentation.spryker.com/v4/docs/glue-application-feature-integration-201907)|
|Product Relation|202001.0||
|Cart|202001.0| [Cart API](https://documentation.spryker.com/v4/docs/cart-feature-integration-201907) ||
Product|202001.0|[Products API](https://documentation.spryker.com/v4/docs/products-feature-integration-201907)|

### 1) Install the Required Modules Using Composer
Run the following command to install the required modules:

```bash
composer require spryker/related-products-rest-api:"^1.0.0" spryker/up-selling-products-rest-api:"^1.0.0" --update-with-dependencies
```
<section contenteditable="false" class="warningBox"><div class="content">
    Make sure that the following modules have been installed:
    
|Module|Expected Directory|
|---|---|
|`RelatedProductsRestApi`|`vendor/spryker/related-products-rest-api`|
|`UpSellingProductsRestApi`|`vendor/spryker/up-selling-products-rest-api`|
</div></section>

### 2) Set up Behavior
Set up the following behaviour.

#### Enable Resources and Relationships
Activate the following plugins:

|Plugin|Specification|Prerequisites|Namespace|
|---|---|---|---|
|`RelatedProductsResourceRoutePlugin`|Retrieves the related products collection.|None|`Spryker\Glue\RelatedProductsRestApi\Plugin\GlueApplication`|
|`CartUpSellingProductsResourceRoutePlugin`|Retrieves the up-selling products collection for the cart.|None|`Spryker\Glue\UpSellingProductsRestApi\Plugin\GlueApplication`|
|`GuestCartUpSellingProductsResourceRoutePlugin`|Retrieves the up-selling products collection for the guest cart.|None|`Spryker\Glue\UpSellingProductsRestApi\Plugin\GlueApplication`|


**src/Pyz/Glue/GlueApplication/GlueApplicationDependencyProvider.php**

```php
<?php
 
namespace Pyz\Glue\GlueApplication;
 
use Spryker\Glue\GlueApplication\GlueApplicationDependencyProvider as SprykerGlueApplicationDependencyProvider;
use Spryker\Glue\RelatedProductsRestApi\Plugin\GlueApplication\RelatedProductsResourceRoutePlugin;
use Spryker\Glue\UpSellingProductsRestApi\Plugin\GlueApplication\CartUpSellingProductsResourceRoutePlugin;
use Spryker\Glue\UpSellingProductsRestApi\Plugin\GlueApplication\GuestCartUpSellingProductsResourceRoutePlugin;
 
class GlueApplicationDependencyProvider extends SprykerGlueApplicationDependencyProvider
{
    /**
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface[]
     */
    protected function getResourceRoutePlugins(): array
     {
        return [
            new RelatedProductsResourceRoutePlugin(),
            new CartUpSellingProductsResourceRoutePlugin(),
            new GuestCartUpSellingProductsResourceRoutePlugin(),
        ];
    }
}


{% info_block warningBox "Verification" %}

Make sure that the following endpoints are available:
http://glue.mysprykershop.com/abstract-products/`{% raw %}{{{% endraw %}abstract_product_sku{% raw %}}}{% endraw %}`e/related-products
http://glue.mysprykershop.com/carts/`{% raw %}{{{% endraw %}cart_uuid{% raw %}}}{% endraw %}`/up-selling-products
http://glue.mysprykershop.com/guest-carts/`{% raw %}{{{% endraw %}guest_cart_uuid{% raw %}}}{% endraw %}`/up-selling-products

{% endinfo_block %}



 
<!-- Last review date: Aug 02, 2019* by Eugenia Poidenko, Yuliia Boiko-->