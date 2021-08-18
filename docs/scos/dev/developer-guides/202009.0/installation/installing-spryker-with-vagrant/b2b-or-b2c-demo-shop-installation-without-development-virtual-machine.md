---
title: B2B or B2C Demo Shop installation- without Development Virtual Machine
description: Learn how to install a B2B or a B2C Demo Shop without the Development Virtual Machine
originalLink: https://documentation.spryker.com/v6/docs/b2b-b2c-demo-shop-installation-without-development-virtual-machine
originalArticleId: 480a1493-35dd-4587-aac8-20f83665f6bc
redirect_from:
  - /v6/docs/b2b-b2c-demo-shop-installation-without-development-virtual-machine
  - /v6/docs/en/b2b-b2c-demo-shop-installation-without-development-virtual-machine
---

To install the Demo Shop for [B2B](/docs/scos/user/intro-to-spryker/{{site.version}}/b2b-suite.html) or [B2C](/docs/scos/user/intro-to-spryker/b2c-suite.html) implementations without the Development Virtual Machine, follow the steps below.

### Minimum requirements

* PHP v7.1.x

  ```bash
  apt-get install php-curl php-json php-mysql php-pdo-sqlite php-sqlite3 php-gd php-intl php-mysqli php-pgsql php-ssh2 php-gmp php-mcrypt php-pdo-mysql php-readline php-twig php-imagick php-memcache php-pdo-pgsql php-redis php-xml php-bz2 php-mbstring
  ```

* Jenkins
  Install appropriate version for your system, refer to <https://jenkins.io/download/>.
  Make sure it runs on port **localhost:10007**, otherwise update config.

* Elasticsearch v5.x (preferably v5.6.x) or v6.x
  Install appropriate version for your system, refer to <https://www.elastic.co/guide/en/elasticsearch/guide/current/running-elasticsearch.html>. Make sure it runs on **localhost:10005**, otherwise update config.

* Graphviz v2.x
  Follow the instructions at <https://www.graphviz.org/download/>.

* Nginx or Apache

* Redis v3.x
  Make sure it runs on **localhost:10009**, otherwise update config.

* MariaDB v10.2+

* RabbitMQ v3.6+

### Nginx configuration
#### Nginx configuration for Yves

The following configuration must be included for Yves in the Nginx configuration file.

```php
location / {
    if (-f $document_root/maintenance.html) {
        return 503;
    }

    # CORS - Allow Ajax requests from http to https webservices on the same domain
    #more_set_headers "Access-Control-Allow-Origin: http://$server_name";
    #more_set_headers "Access-Control-Allow-Credentials: true";
    #more_set_headers "Access-Control-Allow-Headers: Authorization";

    # CORS - Allow Ajax calls from cdn/static scripts
    if ($http_origin ~* "^(http|https)://(img[1234]|cdn|static|cms)\.") {
      add_header "Access-Control-Allow-Origin" $http_origin;
    }

    # Frontend - force browser to use new rendering engine
    #more_set_headers "X-UA-Compatible: IE=Edge,chrome=1";

    # Terminate OPTIONS requests immediately. No need for calling php
    # OPTIONS is used by Ajax from http to https as a pre-flight-request
    # see http://en.wikipedia.org/wiki/Cross-origin_resource_sharing
    if ($request_method = OPTIONS) {
        return 200;
    }

    add_header X-Server $hostname;

    try_files $uri @rewriteapp;

    #more_clear_headers 'X-Powered-By' 'X-Store' 'X-Locale' 'X-Env' 'Server';
}

location @rewriteapp {
    # rewrite all to app.php
    rewrite ^(.*)$ /index.php last;
}

```

#### Nginx configuration for Zed

The following configuration must be included for Yves in the Nginx configuration file.

```php
# Timeout for Zed requests - 10 minutes
# (longer requests should be converted to jobs and executed via jenkins)
proxy_read_timeout 600s;
proxy_send_timeout 600s;
fastcgi_read_timeout 600s;
client_body_timeout 600s;
client_header_timeout 600s;
send_timeout 600s;

# Static files can be delivered directly
location ~ (/images/|/scripts|/styles|/fonts|/bundles|/favicon.ico|/robots.txt) {
    access_log        off;
    expires           30d;
    add_header Pragma public;
    add_header Cache-Control "public, must-revalidate, proxy-revalidate";
    try_files $uri =404;
}

# Payone - PHP application gets all other requests without authorized
location /payone/ {
    auth_basic off;
    add_header X-Server $hostname;
    try_files $uri @rewriteapp;
}

# PHP application gets all other requests
location / {
    #add_header X-Server $hostname;
    try_files $uri @rewriteapp;
    #more_clear_headers 'X-Powered-By' 'X-Store' 'X-Locale' 'X-Env' 'Server';

}

location @rewriteapp {
    # rewrite all to app.php
    rewrite ^(.*)$ /index.php last;
}

```

### Configuration files

#### Database

Edit `config_local.php` to configure the database access:

```php
<?php
$config[ApplicationConstants::ZED_DB_USERNAME] = 'development';
$config[ApplicationConstants::ZED_DB_PASSWORD] = 'mate20mg';
$config[ApplicationConstants::ZED_DB_DATABASE] = 'DE_development_zed';
$config[ApplicationConstants::ZED_DB_HOST] = '127.0.0.1';
$config[ApplicationConstants::ZED_DB_ENGINE] = $config[PropelConfig::DB_ENGINE_MYSQL];
$config[ApplicationConstants::ZED_DB_PORT] = 5432;

```

#### Redis

Configure Redis in your local configuration file:

```php
<?php
$config[ApplicationConstants::YVES_STORAGE_SESSION_REDIS_PROTOCOL] = 'tcp';
$config[ApplicationConstants::YVES_STORAGE_SESSION_REDIS_HOST] = '127.0.0.1';
$config[ApplicationConstants::YVES_STORAGE_SESSION_REDIS_PORT] = '10009';
$config[ApplicationConstants::YVES_STORAGE_SESSION_REDIS_PASSWORD] = '';

```

#### Elasticsearch

Configure Elasticsearch in your local configuration file:

```php
<?php
$config[ApplicationConstants::ELASTICA_PARAMETER__HOST] = 'localhost';
$config[ApplicationConstants::ELASTICA_PARAMETER__TRANSPORT] = 'http';
$config[ApplicationConstants::ELASTICA_PARAMETER__PORT] = '10005';
$config[ApplicationConstants::ELASTICA_PARAMETER__AUTH_HEADER] = '';
$config[ApplicationConstants::ELASTICA_PARAMETER__INDEX_NAME] = 'index_page';
$config[ApplicationConstants::ELASTICA_PARAMETER__DOCUMENT_TYPE] = 'page';
```

Configure Elasticsearch localized parameters:

```php
<?php
{% raw %}{{{% endraw %}$config[ApplicationConstants::ELASTICA_PARAMETER__INDEX_NAME] = 'de_search';{% raw %}}}{% endraw %}
```

#### RabbitMQ

Configure RabbitMQ permissions and virtual hosts according to the instructions in [Tutorial - Set Up a "Hello World" Queue - Legacy Demoshop](http://documentation.spryker.com/v4/docs/setup-hello-world-queue#rabbitmq-management-ui).

#### Hostname

If you want to configure the hostname, set the values for Yves and Zed hostnames in your local configuration file:

* `$config[ApplicationConstants::HOST_ZED]`
* `$config[ApplicationConstants::HOST_YVES]`

### Installing the shop

1. Clone the necessary store repository:
* For the B2B shop, clone the [B2B Demo Shop repository](https://github.com/spryker-shop/b2b-demo-shop).
* For the B2C shop, clone the [B2C Demo Shop repository](https://github.com/spryker-shop/b2c-demo-shop).

2. Run the installation commands inside the project folder:

   ```bash
   composer install
   vendor/bin/install
   ```
   
   
 When the installation process is complete, Spryker Commerce OS is ready to use. It can be accessed via the following links:

**B2B Demo Shop:**
 * [http://de.b2b-demo-shop.local](http://de.b2b-demo-shop.local)- front-end (Storefront);
* [http://zed.de.b2b-demo-shop.local](http://zed.de.b2b-demo-shop.local)- backend (the Back Office).
* [http://glue.de.b2b-demo-shop.local](http://glue.de.b2b-demo-shop.local)- REST API (Glue).

**B2C Demo Shop:**
* [http://de.b2c-demo-shop.local/](http://www.de.b2c-demo-shop.local/){target="_blank"} - front-end (Storefront);
* [http://zed.de.b2c-demo-shop.local/](http://zed.de.b2c-demo-shop.local/){target="_blank"} - backend (the Back Office).
* [http://glue.de.b2c-demo-shop.local/](http://glue.de.b2c-demo-shop.local/){target="_blank"} - REST API (Glue).

Credentials to access the administrator interface: user `admin@spryker.com` and password `change123`.

## Next steps:
* [Troubleshooting installation issues](/docs/scos/dev/developer-guides/202009.0/troubleshooting/spryker-in-vagrant-issues/databases-and-services-issues/peer-authentication-failed-for-user-postgres.html)
