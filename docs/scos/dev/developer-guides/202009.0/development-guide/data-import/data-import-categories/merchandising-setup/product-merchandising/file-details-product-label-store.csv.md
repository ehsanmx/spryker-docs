---
title: File details- product_label_store.csv
description: Description of the product_label_store.csv import file used to import store relations of product labels.
originalLink: https://documentation.spryker.com/v6/docs/file-details-product-label-storecsv
originalArticleId: 808fb4f7-a2ff-4568-a91b-1b5c51cae9f1
redirect_from:
  - /v6/docs/file-details-product-label-storecsv
  - /v6/docs/en/file-details-product-label-storecsv
---

This article contains content of the **product_label_store.csv** file to configure [Product Label](/docs/scos/dev/features/202009.0/product-labels/product-labels.html) information on your Spryker Demo Shop.

## Headers & Mandatory Fields 
These are the header fields to be included in the .csv file:

| Field Name | Mandatory | Type | Other Requirements/Comments | Description |
| --- | --- | --- | --- | --- |
| **name** | Yes | String |N/A* | Name of the label. |
| **store_name** | No | String |N/A | Defines the store realtion of the product label. |
*N/A: Not applicable.


## Dependencies

This file has the following dependency:
*    [product_label.csv](/docs/scos/dev/developer-guides/202009.0/development-guide/data-import/data-import-categories/merchandising-setup/product-merchandising/file-details-product-label.csv.html)

## Template File & Content Example
A template and an example of the *product_label_store.csv*  file can be downloaded here:

| File | Description |
| --- | --- |
| [product_label_store.csv template](https://spryker.s3.eu-central-1.amazonaws.com/docs/Developer+Guide/Back-End/Data+Manipulation/Data+Ingestion/Data+Import/Data+Import+Categories/Merchandising+Setup/Product+Merchandising/Template+product_label_store.csv) | Product Label .csv template file (empty content, contains headers only). |
| [product_label_store.csv](https://spryker.s3.eu-central-1.amazonaws.com/docs/Developer+Guide/Back-End/Data+Manipulation/Data+Ingestion/Data+Import/Data+Import+Categories/Merchandising+Setup/Product+Merchandising/product_label_store.csv) | Product Label .csv file containing a Demo Shop data sample. |