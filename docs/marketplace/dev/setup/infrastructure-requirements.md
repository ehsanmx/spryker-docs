---
title: Infrastructure requirements
description: This article provides the required system infrastructure requirements for a Spryker Marketplace project.
template: concept-topic-template
---

To mitigate security risks, this article describes the system infrastructure requirements for Spryker Marketplace projects.
When you host your Spryker application in SCCOS, these requirements will be configured for you out of the box. If your system infrastructure (cloud PaaS or on-premise) is managed, you must ensure these security requirements are met.

## Applications resources visibility

This section contains details about the visibility of the resources in the network

| SERVICE                          | RESOURCES AVAILABLE               | EXPOSED TO WAN? |
| -------------------------------- | --------------------------------- | ---------------- |
| MerchantPortal                   | PrimaryDatabase, QueueBroker, MerchantPortalSessionStorage | yes
| Backoffice                       | PrimaryDatabase, QueueBroker, BackofficeSessionStorage | **no, accessed through VPN**
| Scheduler                        | PrimaryDatabase, QueueBroker, Storage, Search | no, accessed through a Bastion
| Glue                             | Storage, Search, Gateway | yes
| Yves                             | Storage, Search, Gateway | yes

This diagram illustrates how visibility of resources relates to private and public network relationships:

![Entity diagram](https://confluence-connect.gliffy.net/embed/image/ea46f6b1-fcff-4d7f-b8f5-7c963eb26ffb.png?utm_medium=live&utm_source=custom)

## Merchant Portal endpoints whitelisting

Merchant Portal is exposed to WAN and MUST NOT provide any Gateway or Backoffice facilities.

In the webserver configuration (AWS WAF can also be used), only HTTP endpoints of the `MerchantPortalGui` should be allowed. Their prefix is all the same (/domain-merchant-portal-gui).

`/^[a-zA-Z-]+-merchant-portal-gui.*` - use this pattern as a whitelist in Nginx (or WAF) configuration.

## Merchant portal network

In order for the Merchant Portal to function properly, it should be in a dedicated public network (not the same network where Yves/Glue runs) with access to a network Database and QueueBroker (see diagram above).


## Firewall rules for the Merchant Portal (NACLs or Security groups)

To properly configure Merchant Portal firewall, use these rules:

| FIREWALL       | FROM                | TO                  | ACTION     |
| -------------- | ------------------- | ------------------- | ---------- |
| SG / NACLs     | Merchant Portal     | Redis(session):6379 | Allow      |
| NACLs          | Redis(session):6379     | Merchant Portal | Allow      |
| SG / NACLs     | Merchant Portal     | RDS:3306 | Allow                 |
| NACLs          | RDS:3306     | Merchant portal | Allow                 |
| SG / NACLs     | Merchant Portal     | RabbitMQ:5672 | Allow            |
| NACLs          | RabbitMQ:5672     | Merchant Portal | Allow            |
| SG / NACLs     | Nginx     | Merchant portal:900x | Allow               |
| NACLs          | Merchant Portal:9001     | Nginx | Allow               |
| Default rule   | any     | Merchant Portal | Deny                       |

- Security groups and host-based firewalls must also implement "allow" rules for Merchant portal on Redis, RDS, Rabbit MQ, and Nginx sides.
- In addition, depending on the monitoring system used, "allow" rules will need to be implemented as well.

## Database (MariaDb/Mysql/Postgres)

Each database user must have dedicated user credentials:

| USER                      | DATABASE USER RIGHTS               |
| ------------------------- | ---------------------------- |
| Scheduler                 | FULL ADMIN [Create schema, create tables, drop tables, create users, etc]     |
| Gateway                   | CRUD for the tables         |
| MerchantPortal            | CRUD for the tables related to MerchantPortal. By default the same as Gateway |

## Storage and Search

Each application must have the following user rights:

| USER                   | USER RIGHTS               |
| ---------------------- | ------------------------- |
| GLUE                   | Read-only         |
| Yves                   | Read-only         |
| Scheduler              | Read-write        |
| Merchant Portal        | none              |
