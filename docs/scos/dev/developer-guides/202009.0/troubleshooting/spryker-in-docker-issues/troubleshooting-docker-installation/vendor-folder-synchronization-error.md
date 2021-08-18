---
title: Vendor folder synchronization error
description: Learn how to fix the vendor folder synchronization error
originalLink: https://documentation.spryker.com/v6/docs/vendor-folder-synchronization-error
originalArticleId: f6626598-76e1-4d58-a4c8-291a6011125a
redirect_from:
  - /v6/docs/vendor-folder-synchronization-error
  - /v6/docs/en/vendor-folder-synchronization-error
---

## Description
You get an error similar to `vendor/bin/console: not found`.

## Solution
Re-build basic images, assets, and codebase:
```bash
docker/sdk up --build --assets
```