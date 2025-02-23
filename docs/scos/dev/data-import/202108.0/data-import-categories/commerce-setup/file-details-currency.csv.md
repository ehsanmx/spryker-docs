---
title: File details- currency.csv
last_updated: Jun 16, 2021
template: data-import-template
originalLink: https://documentation.spryker.com/2021080/docs/file-details-currencycsv
originalArticleId: d4ee04b4-8159-4846-9c3a-d98c28423b5c
redirect_from:
  - /2021080/docs/file-details-currencycsv
  - /2021080/docs/en/file-details-currencycsv
  - /docs/file-details-currencycsv
  - /docs/en/file-details-currencycsv
---

This article contains content of the **currency.csv** file to configure [Currency](/docs/scos/dev/back-end-development/data-manipulation/datapayload-conversion/multiple-currencies-per-store-configuration.html) information on your Spryker Demo Shop.

## Headers & Mandatory Fields
These are the header fields to be included in the .csv file:

|  | Field Name | Mandatory | Type | Other Requirements/Comments | Description |
| --- | --- | --- | --- | --- | --- |
| 1 | **iso_code** | Yes | String | N/A* | Currency ISO code. <br>For more details check [ISO 4217 CURRENCY CODES](https://www.iso.org/iso-4217-currency-codes.html).  |
| 2 | **currency_symbol** | Yes | String | N/A | Currency symbol. |
| 3 | **name** | Yes | String |N/A  | Currency name. |
*N/A: Not applicable.

## Dependencies
This file has no dependencies.

## Recommendations

It is recommended to fill all three columns, when adding a new record, except if the “currency” being added is not an ISO standard currency (i.e. system of points, or product/service exchange, etc.).

Default currency might be set up when setting up the store. Check [here](https://github.com/spryker-shop/b2c-demo-shop/blob/master/config/Shared/stores.php#L38).

## Template File & Content Example
A template and an example of the *currency.csv* file can be downloaded here:

| File | Description |
| --- | --- |
| [currency.csv template](https://spryker.s3.eu-central-1.amazonaws.com/docs/Developer+Guide/Back-End/Data+Manipulation/Data+Ingestion/Data+Import/Data+Import+Categories/Commerce+Setup/Template+currency.csv) | Currency .csv template file (empty content, contains headers only). |
| [currency.csv](https://spryker.s3.eu-central-1.amazonaws.com/docs/Developer+Guide/Back-End/Data+Manipulation/Data+Ingestion/Data+Import/Data+Import+Categories/Commerce+Setup/currency.csv) | Currency .csv file containing a Demo Shop data sample. |
