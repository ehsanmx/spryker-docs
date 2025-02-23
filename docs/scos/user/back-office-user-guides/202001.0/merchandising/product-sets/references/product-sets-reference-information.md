---
title: Product Sets- Reference Information
description: This guide describes the values you enter when creating or updating product sets in the Back Office.
last_updated: Nov 22, 2019
template: back-office-user-guide-template
originalLink: https://documentation.spryker.com/v4/docs/product-sets-reference-information
originalArticleId: 8c9ceb7b-1b11-4435-8b9d-69d9efae006b
redirect_from:
  - /v4/docs/product-sets-reference-information
  - /v4/docs/en/product-sets-reference-information
---

This article describes the attributes that you select and enter while creating or managing product sets.
***
## Product Sets page
On the Product Sets page, you see a table with all product sets available in the system. 
For each product set, the following information is presented:

* The autogenerated product set ID
* Product set name
* The number of products included in the product set
* The weight of the product set
* Product set status (either Active or Inactive)
* The actions that you can do on a product set (View, Edit, Deactivate, Delete)
***
## Create/Edit Product Set page
The following tables describe the attributes that you enter and select while creating or managing a product set.
**General tab**
| Attribute |Description  |
| --- | --- |
| **Name** | The name of your product set. |
| **Url** | The URL slug for your product set. Do not leave spaces in this tag. Instead, any multi-word URL fill in the spaces with a dash or underscore.|
| **Description** | An eye-catching description for your product set. |
| **Product Set Key** |This attribute is needed when you want to define a specific page to display the product set. It is important to note when creating your Product Set Key to not include spaces. Please use an underscore or dash instead of spaces otherwise the content widget cannot read it. |
| **Weight** | The number that represents the importance of your product set. Product sets with a higher weight will be shown first or on top.|
| **Active** | A checkbox that defines if the Product Set is displayed anywhere in the online store. |

**SEO tab**

| Attribute |Description  |
| --- | --- |
| **Title** | A SEO-friendly title for the product set. |
| **Keywords**|Any SEO relevant keywords for an added boost in search ranking. |
| **Description** |A SEO-friendly product set description.  |
**Images tab**

| Attribute | Description |
| --- | --- |
| **Image Set Name** |A name of your image set. No spaces are allowed, please use an underscore or dash. |
| **Small Image URL**<br>**Large Image URL** | Allows adding images via a URL. Please make sure the image you are adding is available from a public URL. This means any images in a private Dropbox or Google folder will not work. |
| **Sort Order**|If you add several images to an active image set, specify the order in which they are to be shown in the front end and back end using Sort Order fields. The order of images is defined by the order of entered numbers where the image set with sort order "0" is the first to be shown. |  

## Product Set Example
This is how the product set looks like in the online store:
![Product set example](https://spryker.s3.eu-central-1.amazonaws.com/docs/User+Guides/Back+Office+User+Guides/Products/Products/Product+Sets/Product+Sets%3A+Reference+Information/product-set-example.png) 

The Back Office set up for this product set looks the following way:
![Product set in the Back Office](https://spryker.s3.eu-central-1.amazonaws.com/docs/User+Guides/Back+Office+User+Guides/Products/Products/Product+Sets/Product+Sets%3A+Reference+Information/product-set-in-back-office.png) 

![Product set in the Back Office](https://spryker.s3.eu-central-1.amazonaws.com/docs/User+Guides/Back+Office+User+Guides/Products/Products/Product+Sets/Product+Sets%3A+Reference+Information/product-set-example-in-back-office.png) 
