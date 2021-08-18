---
title: Running and Reverting a Database Migration
description: Database migration allows you to update your database with the latest changes.
originalLink: https://documentation.spryker.com/v5/docs/running-reverting-db-migration
originalArticleId: 2942e07b-e044-4f6a-8a1d-2db99ef2fa48
redirect_from:
  - /v5/docs/running-reverting-db-migration
  - /v5/docs/en/running-reverting-db-migration
---

Database migration allows you to update your database with the latest changes.

To see the list of all the commands related to the migration process, run
`vendor/bin/propel list`

To revert the database migration, run
`vendor/bin/propel migration:down --config-dir=src/Orm/Propel/STORE/Config/development`

<!-- Last review date: Nov 6, 2018 by Rene Klatt, Helen Kravchenko -->
