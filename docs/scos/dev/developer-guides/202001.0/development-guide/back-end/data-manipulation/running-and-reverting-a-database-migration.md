---
title: Running and Reverting a Database Migration
description: Database migration allows you to update your database with the latest changes.
originalLink: https://documentation.spryker.com/v4/docs/running-reverting-db-migration
originalArticleId: 8376e133-2418-4c8e-8e57-f7bb8e08197e
redirect_from:
  - /v4/docs/running-reverting-db-migration
  - /v4/docs/en/running-reverting-db-migration
---

Database migration allows you to update your database with the latest changes.

To see the list of all the commands related to the migration process, run
`vendor/bin/propel list`

To revert the database migration, run
`vendor/bin/propel migration:down --config-dir=src/Orm/Propel/STORE/Config/development`

<!-- Last review date: Nov 6, 2018 by Rene Klatt, Helen Kravchenko -->
