---
title: Glue API - Wishlist feature integration
description: This guide will navigate you through the process of installing and configuring the Wishlist API feature in Spryker OS.
last_updated: Aug 13, 2020
template: feature-integration-guide-template
originalLink: https://documentation.spryker.com/v4/docs/glue-api-wishlist-feature-integration
originalArticleId: 87d48f19-e12d-4bd1-94db-7a405a575a32
redirect_from:
  - /v4/docs/glue-api-wishlist-feature-integration
  - /v4/docs/en/glue-api-wishlist-feature-integration
related:
  - title: Managing Wishlists
    link: docs/scos/dev/glue-api-guides/page.version/managing-wishlists/managing-wishlists.html
---

## Install Feature API
### Prerequisites
To start feature integration, overview and install the necessary features:
|Name|Version|Integration guide|
|---|---|---|
Spryker Core|201907.0|[Glue Application feature integration](/docs/scos/dev/feature-integration-guides/{{page.version}}/glue-api/glue-api-glue-application-feature-integration.html)|
| Glue API: Products | 201907.0 | [Glue API: Products feature integration](/docs/scos/dev/feature-integration-guides/{{page.version}}/glue-api/glue-api-product-feature-integration.html) |
|Wishlist| 201907.0 |

### 1) Install the required modules using Composer
Run the following command to install the required modules:

```bash
composer require spryker/wishlists-rest-api:"^1.0.0" --update-with-dependencies
```
<section contenteditable="false" class="warningBox"><div class="content">
    Make sure that the following module has been installed:

|Module|Expected directory|
|---|---|
|`WishlistsRestApi`|`vendor/spryker/wishlists-rest-apiWishlistItems`|

</div></section>

### 2) Set Up Database Schema and Transfer Objects
Run the following commands to apply database changes, and generate entity and transfer changes:

```bash
console transfer:generate
console propel:install
console transfer:generate
```

<section contenteditable="false" class="warningBox"><div class="content">
    Make sure that the following changes have occurred in the database:

|Database entity|Type|Event|
|---|---|---|
|`spy_wishlist.uuid`|column|added|
</div></section>

<section contenteditable="false" class="warningBox"><div class="content">
Make sure that the following changes have occurred in transfer objects:

|Transfer|Type|Event|Path|
|---|---|---|---|
|`RestWishlistItemsAttributesTransfer`|class|created|`src/Generated/Shared/Transfer/RestWishlistItemsAttributesTransfer`|
|`RestWishlistsAttributesTransfer`|class|created|`src/Generated/Shared/Transfer/RestWishlistsAttributesTransfer`|
|`WishlistTransfer.uuid`|property|added|`src/Generated/Shared/Transfer/WishlistTransfer`|
</div></section>

### 3) Set Up Behavior
#### Migrate data in the database

{% info_block infoBox %}
The following steps generate UUIDs for existing entities in the `spy_wishlist` table.
{% endinfo_block %}

Run the following command:

```bash
console uuid:update Wishlist spy_wishlist
```

{% info_block warningBox "(Make sure that the `uuid` field is populated for all records in the `spy_wishlist` table.<br>For this purpose, run the following SQL query and make sure that the result is 0 records:<br>`SELECT COUNT(*) FROM spy_wishlist WHERE uuid IS NULL;`)

#### Enable resources and relationships

Activate the following plugins:

|Plugin|Specification|Prerequisites|Namespace|
|---|---|---|---|
|`WishlistsResourceRoutePlugin`|Registers the wishlists resource.|None|`Spryker\Glue\WishlistsRestApi\Plugin`|
|`WishlistItemsResourceRoutePlugin`|Registers the wishlist-items resource.|None|`Spryker\Glue\WishlistsRestApi\Plugin`|
|`WishlistRelationshipByResourceIdPlugin`|Adds the wishlists resource as a relationship to the customers resource.|None|`Spryker\Glue\WishlistsRestApi\Plugin`|

<details open>
<summary markdown='span'>src/Pyz/Glue/GlueApplication/GlueApplicationDependencyProvider.php</summary>

```php
<?php

namespace Pyz\Glue\GlueApplication;

use Spryker\Glue\CustomersRestApi\CustomersRestApiConfig;
use Spryker\Glue\GlueApplication\GlueApplicationDependencyProvider as SprykerGlueApplicationDependencyProvider;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRelationshipCollectionInterface;
use Spryker\Glue\WishlistsRestApi\Plugin\WishlistItemsResourceRoutePlugin;
use Spryker\Glue\WishlistsRestApi\Plugin\WishlistRelationshipByResourceIdPlugin;
use Spryker\Glue\WishlistsRestApi\Plugin\WishlistsResourceRoutePlugin

class GlueApplicationDependencyProvider extends SprykerGlueApplicationDependencyProvider
{
    /**
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface[]
     */
    protected function getResourceRoutePlugins(): array
    {
        return [
            new WishlistsResourceRoutePlugin(),
            new WishlistItemsResourceRoutePlugin(),
        ];
    }

    /**
     * @param \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRelationshipCollectionInterface $resourceRelationshipCollection
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRelationshipCollectionInterface
     */
    protected function getResourceRelationshipPlugins(
        ResourceRelationshipCollectionInterface $resourceRelationshipCollection
    ): ResourceRelationshipCollectionInterface {
        $resourceRelationshipCollection->addRelationship(
            CustomersRestApiConfig::RESOURCE_CUSTOMERS,
            new WishlistRelationshipByResourceIdPlugin()
        );

        return $resourceRelationshipCollection;
    }
}
```

<br>
</details>

@(Warning" %}

{% endinfo_block %}(Make sure that the following endpoints are available:<ul><li>`http:///glue.mysprykershop.com/wishlists`</li><li>`http:///glue.mysprykershop.com/wishlists/{% raw %}{{{% endraw %}wishlist_id{% raw %}}}{% endraw %}/wishlists-items`</li></ul>Send a request to `http://glue.mysprykershop.com/customers/{% raw %}{{{% endraw %}customer_id{% raw %}}}{% endraw %}?include=wishlists` and make sure that the given customer has at least one wishlist. Make sure that the response includes relationships to the `wishlists` resources.)

**See also:**

* [Managing Wishlists](/docs/scos/dev/glue-api-guides/{{page.version}}/managing-wishlists.html)

*Last review date: Aug 02, 2019* <!-- by  Tihran Voitov, Yuliia Boiko-->
