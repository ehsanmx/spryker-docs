---
title: Retrieving company roles
description: Learn how to retrieve company roles via Glue API.
originalLink: https://documentation.spryker.com/2021080/docs/retrieving-company-roles
originalArticleId: 91e7d4fb-7088-4249-bb24-c146c3a63ea4
redirect_from:
  - /2021080/docs/retrieving-company-roles
  - /2021080/docs/en/retrieving-company-roles
  - /docs/retrieving-company-roles
  - /docs/en/retrieving-company-roles
---

In corporate environments, where users act as company representatives rather than private buyers, companies can leverage [Company Roles](/docs/scos/user/features/{{page.version}}/company-account-feature-overview/company-user-roles-and-permissions-overview.html) to distribute scopes and permissions among [Company Users](/docs/scos/user/features/{{page.version}}/company-account-feature-overview/company-accounts-overview.html). This endpoint allows retrieving information about the company roles.



## Installation
For detailed information on the modules that provide the API functionality and related installation instructions, see [Glue API: Company Account Feature Integration](/docs/scos/dev/feature-integration-guides/{{page.version}}/glue-api/glue-api-company-account-feature-integration.html).

## Retrieve a company role

To retrieve a company role, send the request:

`GET` **/company-roles/*{% raw %}{{{% endraw %}company_role_id{% raw %}}}{% endraw %}***


| Path parameter | Description |
| --- | --- |
| ***{% raw %}{{{% endraw %}company_role_id{% raw %}}}{% endraw %}*** | Unique identifier of a company role to retrieve. Enter `mine` to retrieve the company role of the current authenticated company user. |

### Request


| Header key | Type | Required | Description |
| --- | --- | --- | --- |
| Authorization | string | &check; | String containing digits, letters, and symbols that authorize the company user. [Authenticate as a company user](/docs/scos/dev/glue-api-guides/{{page.version}}/managing-b2b-account/authenticating-as-a-company-user.html#authenticate-as-a-company-user) to get the value. |

| Query parameter | Description | Possible values |
| --- | --- | --- |
| Include | Adds resource relationships to the request. |  |



| Request | Usage |
| --- | --- |
| GET https://glue.mysprykershop.com/company-roles/mine | Retrieve all the copmany roles of the current authenticated company user. |
| GET https://glue.mysprykershop.com/company-roles/2f0a9d3e-9e69-53eb-8518-284a0db04376 | Retrieve the company role with the id `2f0a9d3e-9e69-53eb-8518-284a0db04376`. |
| GET https://glue.mysprykershop.com/company-roles/2f0a9d3e-9e69-53eb-8518-284a0db04376?include=companies | Retrieve the company role with the id `2f0a9d3e-9e69-53eb-8518-284a0db04376` with related companies included. |


#### Response

<details open>
    <summary>Response sample of company roles of the current authenticated company user</summary>
    
```json
{
    "data": [
        {
            "type": "company-roles",
            "id": "2f0a9d3e-9e69-53eb-8518-284a0db04376",
            "attributes": {
                "name": "Admin",
                "isDefault": true
        },
        "links": {
            "self": "https://glue.mysprykershop.com/company-roles/2f0a9d3e-9e69-53eb-8518-284a0db04376"
        }
    }
    ],
    "links": {
        "self": "https://glue.mysprykershop.com/company-roles/mine"
    }
}
```
</details>


<details open>
    <summary>Response sample of a particular company role</summary>

```json
{
    "data": {
        "type": "company-roles",
        "id": "2f0a9d3e-9e69-53eb-8518-284a0db04376",
        "attributes": {
            "name": "Admin",
            "isDefault": true
        },
        "links": {
            "self": "https://glue.mysprykershop.com/company-roles/2f0a9d3e-9e69-53eb-8518-284a0db04376"
        }
    }
}
```

</details>
   
   
<details open>
    <summary>Response sample with companies</summary>
    
```json
{
    "data": {
        "type": "company-roles",
        "id": "2f0a9d3e-9e69-53eb-8518-284a0db04376",
        "attributes": {...},
        "links": {...},
        "relationships": {
            "companies": {
                "data": [
                    {
                        "type": "companies",
                        "id": "0818f408-cc84-575d-ad54-92118a0e4273"
                    }
                ]
            }
        }
    },
    "included": [
        {
            "type": "companies",
            "id": "0818f408-cc84-575d-ad54-92118a0e4273",
            "attributes": {
                "isActive": true,
                "name": "Test Company",
                "status": "approved"
            },
            "links": {
                "self": "https://glue.mysprykershop.com/companies/0818f408-cc84-575d-ad54-92118a0e4273"
            }
        }
    ]
}
```

</details>

| Attribute | Type | Specifies the name of the Company Role. |
| --- | --- | --- |
| name | String | Cell |
| isDefault | Boolean | Indicates whether the Company Role is the default role for the company. |


| Included resource | Attribute | Type | Description |
| --- | --- | --- | --- |
| companies | name | String | Company name. |
| companies | isActive | Boolean | Indicates if the company is active. |
| companies | status | String | Company status. Possible values are: *Pending*, *Approved* or *Denied*. |


## Possible errors

| Code | Reason |
| --- | --- |
| 001 | Authentication token is invalid. |
| 002 | Authentication token is missing. |
|2101 | Company role is not found. |
| 2103 | Current company user is not set. You need to select the current company user with /company-user-access-tokens in order to access the resource collection.


To view generic errors that originate from the Glue Application, see [Reference information: GlueApplication errors](/docs/scos/dev/glue-api-guides/{{page.version}}/reference-information-glueapplication-errors.html).


##  Next steps


* [Retrieve business unit addresses](/docs/scos/dev/glue-api-guides/{{page.version}}/managing-b2b-account/retrieving-business-unit-addresses.html)
* [Manage company user authentication tokens](/docs/scos/dev/glue-api-guides/{{page.version}}/managing-b2b-account/managing-company-user-authentication-tokens.html)