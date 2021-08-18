---
title: Cache of Unresolved Entities for Zed
description: The article provides general description and integration instructions of the Cache of Unresolved Entities for Zed feature
originalLink: https://documentation.spryker.com/2021080/docs/cache-of-unresolved-entities-for-zed
originalArticleId: 1ea10e01-93fd-471a-aa18-824dd055c140
redirect_from:
  - /2021080/docs/cache-of-unresolved-entities-for-zed
  - /2021080/docs/en/cache-of-unresolved-entities-for-zed
  - /docs/cache-of-unresolved-entities-for-zed
  - /docs/en/cache-of-unresolved-entities-for-zed
---

Spryker allows extending certain classes (such as facades, clients, etc.) in projects and in multiple stores. Therefore each class can exist on the core, project, and store level. In addition to that, Spryker supports multiple namespaces for each level. Because of this, there exist multiple possible locations to look up such classes. To avoid unnecessary usages of the expensive `class_exists()` function that does the job, Spryker provides a caching mechanism that writes all non-existing classes into a cache file for Zed. For more details, see[ Activate Class Resolver Cache](/docs/scos/dev/developer-guides/{{page.version}}/development-guide/guidelines/performance-guidelines.html#activate-class-resolver-cache) in Performance Guidelines.

## Integration
Follow the steps below to integrate Cache of Unresolved Entities for Zed into your project to improve performance.

### 1) Install the Required Modules Using Composer
Run the following command to install the required module:
```Bash
composer update spryker/kernel
```
### 2) Set Up Behavior
Add `Spryker\Zed\Kernel\Communication\Plugin\AutoloaderCacheEventDispatcherPlugin` to `Pyz\Zed\EventDispatcher\EventDispatcherDependencyProvider`:

```PHP
<?php

namespace Pyz\Zed\EventDispatcher;

use Spryker\Zed\EventDispatcher\EventDispatcherDependencyProvider as SprykerEventDispatcherDependencyProvider;
use Spryker\Zed\Kernel\Communication\Plugin\AutoloaderCacheEventDispatcherPlugin;

class EventDispatcherDependencyProvider extends SprykerEventDispatcherDependencyProvider
{
    /**
     * @return \Spryker\Shared\EventDispatcherExtension\Dependency\Plugin\EventDispatcherPluginInterface[]
     */
    protected function getEventDispatcherPlugins(): array
    {
        return [
            ...
            new AutoloaderCacheEventDispatcherPlugin(),
        ];
    }
}
```

That's it. You now have the  Cache of Unresolved Entities for Zed feature installed.