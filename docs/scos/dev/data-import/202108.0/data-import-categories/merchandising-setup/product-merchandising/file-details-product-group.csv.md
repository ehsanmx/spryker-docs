---
title: File details- product_group.csv
last_updated: Jun 16, 2021
template: data-import-template
originalLink: https://documentation.spryker.com/2021080/docs/file-details-product-groupcsv
originalArticleId: dafbf02b-ad3c-4a49-b6f4-4f7448b61fca
redirect_from:
  - /2021080/docs/file-details-product-groupcsv
  - /2021080/docs/en/file-details-product-groupcsv
  - /docs/file-details-product-groupcsv
  - /docs/en/file-details-product-groupcsv
---

This article contains content of the **product_group.csv** file to configure [Product Group](/docs/scos/user/features/{{page.version}}/product-groups-feature-overview.html) information on your Spryker Demo Shop.

## Headers & Mandatory Fields 
These are the header fields to be included in the .csv file:

| Field Name | Mandatory | Type | Other Requirements/Comments | Description |
| --- | --- | --- | --- | --- |
| **group_key** | Yes (*unique*) | String |N/A* | Product group unique string identifier. |
| **abstract_sku** | Yes | String |N/A | SKU of the abstract product. |
| **position** | No | Integer |N/A | The position of the product within that group. |
*N/A: Not applicable.

## Dependencies

This file has the following dependency:
*    [product_abstract.csv](/docs/scos/dev/data-import/{{page.version}}/data-import-categories/catalog-setup/products/file-details-product-abstract.csv.html)

## Template File & Content Example
A template and an example of the *product_group.csv*  file can be downloaded here:

| File | Description |
| --- | --- |
| [product_group.csv template](https://spryker.s3.eu-central-1.amazonaws.com/docs/Developer+Guide/Back-End/Data+Manipulation/Data+Ingestion/Data+Import/Data+Import+Categories/Merchandising+Setup/Product+Merchandising/Template+product_group.csv) | Payment Method Store .csv template file (empty content, contains headers only). |
| [product_group.csv](https://spryker.s3.eu-central-1.amazonaws.com/docs/Developer+Guide/Back-End/Data+Manipulation/Data+Ingestion/Data+Import/Data+Import+Categories/Merchandising+Setup/Product+Merchandising/product_group.csv) | Payment Method Store .csv file containing a Demo Shop data sample. |
