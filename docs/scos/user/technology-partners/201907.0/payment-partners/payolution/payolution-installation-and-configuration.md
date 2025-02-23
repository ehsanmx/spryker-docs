---
title: Payolution - Configuration
description: This article contains information on configuring the Payolution module for the Spryker Commerce OS.
last_updated: Nov 22, 2019
template: concept-topic-template
originalLink: https://documentation.spryker.com/v3/docs/payolution-configuration
originalArticleId: 6db71865-46a6-447f-94d2-a176fdcb2b51
redirect_from:
  - /v3/docs/payolution-configuration
  - /v3/docs/en/payolution-configuration
related:
  - title: Payolution - Installment Payment
    link: docs/scos/user/technology-partners/page.version/payment-partners/payolution/payolution-payment-methods/payolution-installment-payment.html
  - title: Payolution - Performing Requests
    link: docs/scos/user/technology-partners/page.version/payment-partners/payolution/technical-details-and-howtos/payolution-performing-requests.html
  - title: Payolution - Workflow
    link: docs/scos/user/technology-partners/page.version/payment-partners/payolution/technical-details-and-howtos/payolution-workflow.html
  - title: Payolution
    link: docs/scos/user/technology-partners/page.version/payment-partners/payolution/payolution.html
  - title: Payolution - Invoice Payment
    link: docs/scos/user/technology-partners/page.version/payment-partners/payolution/payolution-payment-methods/payolution-invoice-payment.html
---

Add `spryker-eco/payolution` to your project by running `composer require spryker-eco/payolution`
Please refer to `config/config.dist.php` for example of module configuration.

To set up the initial Payolution configuration, use the credentials you received after registering your Payolution merchant account:
```php
$config[PayolutionConstants::TRANSACTION_GATEWAY_URL] = '';
$config[PayolutionConstants::CALCULATION_GATEWAY_URL] = '';
$config[PayolutionConstants::TRANSACTION_SECURITY_SENDER] = '';
$config[PayolutionConstants::TRANSACTION_USER_LOGIN] = '';
$config[PayolutionConstants::TRANSACTION_USER_PASSWORD] = '';
$config[PayolutionConstants::CALCULATION_SENDER] = '';
$config[PayolutionConstants::CALCULATION_USER_LOGIN] = '';
$config[PayolutionConstants::CALCULATION_USER_PASSWORD] = '';
$config[PayolutionConstants::TRANSACTION_CHANNEL_PRE_CHECK] = '';
$config[PayolutionConstants::TRANSACTION_CHANNEL_INVOICE] = '';
$config[PayolutionConstants::TRANSACTION_CHANNEL_INSTALLMENT] = '';
$config[PayolutionConstants::CALCULATION_CHANNEL] = '';
```

Next, specify modes and order limits:
```php
$config[PayolutionConstants::TRANSACTION_MODE] = 'CONNECTOR_TEST';
$config[PayolutionConstants::CALCULATION_MODE] = 'TEST';
$config[PayolutionConstants::MIN_ORDER_GRAND_TOTAL_INVOICE] = '500';
$config[PayolutionConstants::MAX_ORDER_GRAND_TOTAL_INVOICE] = '500000';
$config[PayolutionConstants::MIN_ORDER_GRAND_TOTAL_INSTALLMENT] = '500';
$config[PayolutionConstants::MAX_ORDER_GRAND_TOTAL_INSTALLMENT] = '500000';
 ```

### Checkout Configuration

To use Payolution in frontend, Payolution payment method handlers and subforms should be added to `Pyz/Yves/Checkout/CheckoutDependencyProvider.php`
```php
 $container[static::PAYMENT_METHOD_HANDLER] = function () {
 $paymentHandlerPlugins = new StepHandlerPluginCollection();

 $paymentHandlerPlugins->add(new PayolutionHandlerPlugin(), PaymentTransfer::PAYOLUTION_INVOICE);
 $paymentHandlerPlugins->add(new PayolutionHandlerPlugin(), PaymentTransfer::PAYOLUTION_INSTALLMENT);

 return $paymentHandlerPlugins;
 };

 $container[static::PAYMENT_SUB_FORMS] = function () {
 $paymentSubFormPlugins = new SubFormPluginCollection();

 $paymentSubFormPlugins->add(new PayolutionInstallmentSubFormPlugin());
 $paymentSubFormPlugins->add(new PayolutionInvoiceSubFormPlugin());

 return $paymentSubFormPlugins;
 };
 ```

All subform and handler plugins are located in `SprykerEco\Yves\Payolution\Plugin\` namespace.

### OMS Configuration

Please activate the following Payolution process.
```php
$config[OmsConstants::ACTIVE_PROCESSES][] = 'PayolutionPayment01';
 ```

Default implementation for commands and options should be added to `Pyz/Zed/Oms/OmsDependencyProvider.php`

Commands:
```php
$container->extend(OmsDependencyProvider::COMMAND_PLUGINS, function (CommandCollectionInterface $commandCollection) {
    $commandCollection
        ->add(new PreAuthorizePlugin(), 'Payolution/PreAuthorize')
        ->add(new ReAuthorizePlugin(), 'Payolution/ReAuthorize')
        ->add(new RevertPlugin(), 'Payolution/Revert')
        ->add(new CapturePlugin(), 'Payolution/Capture')
        ->add(new RefundPlugin(), 'Payolution/Refund');

    return $commandCollection;
});
```
Conditions:
```php
$container->extend(OmsDependencyProvider::CONDITION_PLUGINS, function (ConditionCollectionInterface $conditionCollection) {
    $conditionCollection
        ->add(new IsPreAuthorizationApprovedPlugin(), 'Payolution/IsPreAuthorizationApproved')
        ->add(new IsReAuthorizationApprovedPlugin(), 'Payolution/IsReAuthorizationApproved')
        ->add(new IsReversalApprovedPlugin(), 'Payolution/IsReversalApproved')
        ->add(new IsCaptureApprovedPlugin(), 'Payolution/IsCaptureApproved')
        ->add(new IsRefundApprovedPlugin(), 'Payolution/IsRefundApproved');

    return $conditionCollection;
});
```

All commands and conditions are located in `SprykerEco\Zed\Payolution\Communication\Plugin\Oms\` namespace.

### Payment Configuration

Default implementation for checkout payment plugins should be added to `Pyz/Zed/Payment/PaymentDependencyProvider.php`
```php
 $container->extend(static::CHECKOUT_PLUGINS, function (CheckoutPluginCollection $pluginCollection) {
 $pluginCollection
 ->add(new PayolutionPreCheckPlugin(), PayolutionConfig::PROVIDER_NAME, static::CHECKOUT_PRE_CHECK_PLUGINS)
 ->add(new PayolutionSaveOrderPlugin(), PayolutionConfig::PROVIDER_NAME, static::CHECKOUT_ORDER_SAVER_PLUGINS)
 ->add(new PayolutionPostCheckPlugin(), PayolutionConfig::PROVIDER_NAME, static::CHECKOUT_POST_SAVE_PLUGINS);

 return $pluginCollection;
 });
 ```

All payment plugins are located in `SprykerEco\Zed\Payolution\Communication\Plugin\Checkout\` namespace.
