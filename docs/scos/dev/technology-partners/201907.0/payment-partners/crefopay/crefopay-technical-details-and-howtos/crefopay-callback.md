---
title: CrefoPay - Callback
description: Callbacks are redirects performed by the CrefoPay system.
originalLink: https://documentation.spryker.com/v3/docs/crefopay-callback
originalArticleId: a436e286-4950-4fb3-800a-329c557f3638
redirect_from:
  - /v3/docs/crefopay-callback
  - /v3/docs/en/crefopay-callback
---

Callbacks are redirects performed by the CrefoPay system. The CrefoPay system redirects customers back to the URLs configured for the merchants shop. For each shop, you can define a single URL of each of the following types: confirmation, success and error.
These callbacks are used only for payment methods that redirect to a different page like PayPal.

Callback URLs can be configured in merchant back end and must have the following format:

* Confirmation URL: `http://de.mysprykershop.com/crefo-pay/callback/confirmation `
* Success URL: `http://de.mysprykershop.com/crefo-pay/callback/success`
* Failure URL: `http://de.mysprykershop.com/crefo-pay/callback/failure`