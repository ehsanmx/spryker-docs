---
title: Using a Query Container
description: The query container of the current unterminated query is available via $this->getQueryContainer() in the factory of the communication and the business layer and can be injected into any model.
originalLink: https://documentation.spryker.com/v5/docs/using-a-query-container
originalArticleId: d01589fa-7a87-42c3-bf52-95731b50dc0f
redirect_from:
  - /v5/docs/using-a-query-container
  - /v5/docs/en/using-a-query-container
---

The query container of the current unterminated query is available via `$this->getQueryContainer()` in the [factory](/docs/scos/dev/developer-guides/202005.0/development-guide/back-end/data-manipulation/data-enrichment/factory/creating-instances-of-classes-factory.html) of the communication and the business layer and can be injected into any model.

![Query container via factory](https://spryker.s3.eu-central-1.amazonaws.com/docs/Developer+Guide/Zed/Persistence+Layer/Query+Container/query-container-via-factory.png){height="" width=""}

### Executing the Query

You can adjust the query itself, but you should avoid adding more filters or joins because this is a responsibility of the query container only.

```php
<?php
$templateQuery = $this->queryTemplateByPath($path);
$templateQuery->limit(100);
$templateQuery->offset(10);
$templateCollection = $templateQuery->find(); // or findOne()
```

You can also change the output format, e.g. to array instead of collection:

```php
<?php
$formatter = new SimpleArrayFormatter();
$templateQuery->setFormatter($formatter);
```