---
title: BS Payone
description: Provide full-service payment service and payment transaction services by integrating BS Payone into your Spryker-based shop.
last_updated: Jul 31, 2020
template: concept-topic-template
originalLink: https://documentation.spryker.com/v2/docs/payone-v1-1
originalArticleId: 31bc37a5-5959-457c-bb54-804cfd0cf94a
redirect_from:
  - /v2/docs/payone-v1-1
  - /v2/docs/en/payone-v1-1
related:
  - title: PayOne - Integration into the SCOS Project
    link: docs/scos/user/technology-partners/page.version/payment-partners/bs-payone/scos-integration/payone-integration-into-the-scos-project.html
  - title: PayOne - Risk Check and Address Check
    link: docs/scos/user/technology-partners/page.version/payment-partners/bs-payone/scos-integration/payone-risk-check-and-address-check.html
  - title: PayOne - Prepayment
    link: docs/scos/user/technology-partners/page.version/payment-partners/bs-payone/legacy-demoshop-integration/payone-payment-methods/payone-prepayment.html
  - title: PayOne - Authorization and Preauthorization Capture Flows
    link: docs/scos/user/technology-partners/page.version/payment-partners/bs-payone/legacy-demoshop-integration/payone-authorization-and-preauthorization-capture-flows.html
  - title: PayOne - Invoice Payment
    link: docs/scos/user/technology-partners/page.version/payment-partners/bs-payone/legacy-demoshop-integration/payone-payment-methods/payone-invoice-payment.html
  - title: PayOne - Cash on Delivery
    link: docs/scos/user/technology-partners/page.version/payment-partners/bs-payone/scos-integration/payone-cash-on-delivery.html
  - title: PayOne - Credit Card Payment
    link: docs/scos/user/technology-partners/page.version/payment-partners/bs-payone/legacy-demoshop-integration/payone-payment-methods/payone-credit-card-payment.html
  - title: PayOne - PayPal Express Checkout Payment
    link: docs/scos/user/technology-partners/page.version/payment-partners/bs-payone/legacy-demoshop-integration/payone-paypal-express-checkout-payment.html
  - title: PayOne - Security Invoice Payment
    link: docs/scos/user/technology-partners/page.version/payment-partners/bs-payone/legacy-demoshop-integration/payone-payment-methods/payone-security-invoice-payment.html
---

## Partner Information

[ABOUT BS PAYONE](https://www.payone.com/) 
BS PAYONE GmbH is headquartered in Frankfurt am Main and is one of the leading omnichannel-payment providers in Europe. In addition to providing customer support to numerous Savings Banks (Sparkasse) the full-service payment service provider also provides cashless payment transaction services to more than 255,000 customers from stationary trade to the automated and holistic processing of e-commerce and mobile payments. 

YOUR ADVANTAGES: 

* <b>One solution, one partner, one contract</b>
Simple & efficient. Technical processing and financial services from a single source.
* <b>International payment processing</b>
Access to international and local payment methods.
* <b>Automatic debtor management</b>
Effective accounting support through transaction allocation and reconciliation.
* <b>Credit entries independent of payment type</b>
Fast returns management. With automated refunds.
* <b>Short time to market thanks to plug'n pay</b>
1-click checkout and seamless integration. For an increasing conversion rate. 

We integrate with a wide range of payment methods that can be configured according to your needs and convenience. Payment method flows are configured using state machines.

Payone provides the following methods of payment:

* [Credit Card](/docs/scos/user/technology-partners/201903.0/payment-partners/bs-payone/legacy-demoshop-integration/payone-credit-card-payment.html)
* [Direct Debit](/docs/scos/user/technology-partners/201903.0/payment-partners/bs-payone/legacy-demoshop-integration/payone-direct-debit-payment.html)
* [Online Transfer](/docs/scos/user/technology-partners/201903.0/payment-partners/bs-payone/legacy-demoshop-integration/payone-online-transfer-payment.html)
* [Paypal](/docs/scos/user/technology-partners/201903.0/payment-partners/bs-payone/legacy-demoshop-integration/payone-paypal-payment.html)
* [Prepayment](/docs/scos/user/technology-partners/201903.0/payment-partners/bs-payone/legacy-demoshop-integration/payone-prepayment.html)
* [Invoice](/docs/scos/user/technology-partners/201903.0/payment-partners/bs-payone/legacy-demoshop-integration/payone-invoice-payment.html)
* [Security Invoice](/docs/scos/user/technology-partners/201903.0/payment-partners/bs-payone/legacy-demoshop-integration/payone-security-invoice-payment.html)
* [Paypal Express Checkout](/docs/scos/user/technology-partners/201903.0/payment-partners/bs-payone/legacy-demoshop-integration/payone-paypal-payment.html-express-checkout)

We use state machines for handling and managing orders and payments. To integrate Payone payments, a state machine for Payone should be created.

A basic and fully functional state machine for each payment method is already built:

* `PayoneCreditCard.xml`
* `PayoneDirectDebit.xml`
* `PayoneEWallet.xml`
* `PayoneInvoice.xml`
* `PayoneSecurityInvoice.xml`
* `PayoneOnlineTransfer.xml`
* `PayonePrePayment.xml`
* `PayonePaypalExpressCheckout.xml`

You can use the same state machines or build new ones. The state machine commands and conditions trigger Payone facade calls in order to perform the needed requests to Payone API.

## Integration to Your Project

You can copy over configs to your config from the Payone module's `config.dist.php` file.

The configuration to integrate payments using Payone is:

* `PAYONE_CREDENTIALS_KEY`: payment portal key (required).
* `PAYONE_CREDENTIALS_MID`: merchant id (required).
* `PAYONE_CREDENTIALS_AID`: sub-account id (required).
* `PAYONE_CREDENTIALS_PORTAL_ID`: payment portal id (required).
* `PAYONE_MODE`: the mode of the transaction, either test or live (required).
* `PAYONE_BUSINESS_RELATION`: the business relation of the transaction, b2b or b2c (required).
* `PAYONE_PAYMENT_GATEWAY_URL`: server-API-URL.
* `PAYONE_REDIRECT_SUCCESS_URL`: return URL for successful result on redirect.
* `PAYONE_REDIRECT_ERROR_URL`: return URL for error on redirect.
* `PAYONE_REDIRECT_BACK_URL`: return URL that will be engaged when user cancels action on redirect.
* `PAYONE_EMPTY_SEQUENCE_NUMBER`: sequence number that will be used in API requests when ommitted (0 by default).
* `PAYONE_CREDENTIALS_ENCODING`: encoding of data sent in requests to Payone API ('UTF-8' for the
* `HOST_YVES`: yves host in order to generate urls inside payone module.
* `PAYONE_STANDARD_CHECKOUT_ENTRY_POINT_URL`: entry point url to standart checkout in project(or middleware url in project, depending on your implementation).
* `PAYONE_EXPRESS_CHECKOUT_BACK_URL`: if user presses back button(if so exists) on payone side, this urs is used to redirect user back to shop.
* `PAYONE_EXPRESS_CHECKOUT_FAILURE_URL`: if something goes wrong when the user is on payone side, redirect here is done.

## Integration with Checkout module (CheckoutDependencyProvider):

Project (demoshop) level `\Pyz\Yves\Checkout\CheckoutDependencyProvider` method `provideDependencies` container has to be extended with the `static::PAYMENT_SUB_FORMS` and `static::PAYMENT_METHOD_HANDLER` keys which have to contain information about PSP payment methods SubForms and SubForms Handlers accordingly.

Add the keys to `\Pyz\Yves\Checkout\CheckoutDependencyProvider::provideDependencies`:
```php
<?php
$container[static::PAYMENT_METHOD_HANDLER] = function () {
 $paymentMethodHandler = new StepHandlerPluginCollection();

 $paymentMethodHandler->add(new PayoneHandlerPlugin(), PaymentTransfer::PAYONE_INVOICE);
 $paymentMethodHandler->add(new PayoneHandlerPlugin(), PaymentTransfer::PAYONE_SECURITY_INVOICE);
 $paymentMethodHandler->add(new PayoneHandlerPlugin(), PaymentTransfer::PAYONE_CREDIT_CARD);
 $paymentMethodHandler->add(new PayoneHandlerPlugin(), PaymentTransfer::PAYONE_DIRECT_DEBIT);
 $paymentMethodHandler->add(new PayoneHandlerPlugin(), PaymentTransfer::PAYONE_E_WALLET);
 $paymentMethodHandler->add(new PayoneHandlerPlugin(), PaymentTransfer::PAYONE_ONLINE_TRANSFER);
 $paymentMethodHandler->add(new PayoneHandlerPlugin(), PaymentTransfer::PAYONE_PRE_PAYMENT);
 $paymentMethodHandler->add(new PayoneHandlerPlugin(), PaymentTransfer::PAYONE_PAYPAL_EXPRESS_CHECKOUT);

 return $paymentMethodHandler;
 };

 $container[static::PAYMENT_SUB_FORMS] = function () {
 $paymentSubFormPlugin = new SubFormPluginCollection();

 $paymentSubFormPlugin->add(new PayoneInvoiceSubFormPlugin());
 $paymentSubFormPlugin->add(new PayoneSecurityInvoiceSubFormPlugin());
 $paymentSubFormPlugin->add(new PayoneCreditCardSubFormPlugin());
 $paymentSubFormPlugin->add(new PayoneDirectDebitSubFormPlugin());
 $paymentSubFormPlugin->add(new PayoneEWalletSubFormPlugin());
 $paymentSubFormPlugin->add(new PayoneEpsOnlineTransferSubFormPlugin());
 $paymentSubFormPlugin->add(new PayonePrePaymentSubFormPlugin());

 return $paymentSubFormPlugin;
 };
```

## Integration with Payment module (PaymentDependencyProvider):

Project (demoshop) level `\Pyz\Zed\Payment\PaymentDependencyProvider` method `provideBusinessLayerDependencies` container has to be extended with the `static::CHECKOUT_PLUGINS` key which has to contain information about PSP payment pre-, post-, and -save Order plugins.

Add the key to `\Pyz\Zed\Payment\PaymentDependencyProvider`:
```php
<?php
$container->extend(static::CHECKOUT_PLUGINS, function (CheckoutPluginCollection $pluginCollection) {
 $pluginCollection->add(new PayonePreCheckPlugin(), PayoneConfig::PROVIDER_NAME, static::CHECKOUT_PRE_CHECK_PLUGINS);
 $pluginCollection->add(new PayoneSaveOrderPlugin(), PayoneConfig::PROVIDER_NAME, static::CHECKOUT_ORDER_SAVER_PLUGINS);
 $pluginCollection->add(new PayonePostSaveHookPlugin(), PayoneConfig::PROVIDER_NAME, static::CHECKOUT_POST_SAVE_PLUGINS);

 return $pluginCollection;
 });
```

## Integration with OMS module (OmsDependencyProvider)

    Project (demoshop) level `\Pyz\Zed\Oms\OmsDependencyProvider` method `provideBusinessLayerDependencies` container has to be extended with the static::CONDITION_PLUGINS
    and static::COMMAND_PLUGINS keys which have to contain information about PSP OMS State Machine conditions and commands plugins.

Add the keys to `\Pyz\Zed\Oms\OmsDependencyProvider`:
```php<?php
$container->extend(static::CONDITION_PLUGINS, function (ConditionCollectionInterface $conditionCollection) {
 $conditionCollection->add(new PreAuthorizationIsApprovedConditionPlugin(), 'Payone/PreAuthorizationIsApproved');
 $conditionCollection->add(new AuthorizationIsApprovedConditionPlugin(), 'Payone/AuthorizationIsApproved');
 $conditionCollection->add(new CaptureIsApprovedConditionPlugin(), 'Payone/CaptureIsApproved');
 $conditionCollection->add(new RefundIsApprovedConditionPlugin(), 'Payone/RefundIsApproved');
 $conditionCollection->add(new RefundIsPossibleConditionPlugin(), 'Payone/RefundIsPossible');
 $conditionCollection->add(new PreAuthorizationIsErrorConditionPlugin(), 'Payone/PreAuthorizationIsError');
 $conditionCollection->add(new AuthorizationIsErrorConditionPlugin(), 'Payone/AuthorizationIsError');
 $conditionCollection->add(new PreAuthorizationIsRedirectConditionPlugin(), 'Payone/PreAuthorizationIsRedirect');
 $conditionCollection->add(new AuthorizationIsRedirectConditionPlugin(), 'Payone/AuthorizationIsRedirect');
 $conditionCollection->add(new PaymentIsAppointedConditionPlugin(), 'Payone/PaymentIsAppointed');
 $conditionCollection->add(new PaymentIsCaptureConditionPlugin(), 'Payone/PaymentIsCapture');
 $conditionCollection->add(new PaymentIsPaidConditionPlugin(), 'Payone/PaymentIsPaid');
 $conditionCollection->add(new PaymentIsUnderPaidConditionPlugin(), 'Payone/PaymentIsUnderPaid');
 $conditionCollection->add(new PaymentIsOverpaidConditionPlugin(), 'Payone/PaymentIsOverpaid');
 $conditionCollection->add(new PaymentIsRefundConditionPlugin(), 'Payone/PaymentIsRefund');

 return $conditionCollection;
 });

 $container->extend(static::COMMAND_PLUGINS, function (CommandCollectionInterface $commandCollection) {
 $commandCollection->add(new PreAuthorizeCommandPlugin(), 'Payone/PreAuthorize');
 $commandCollection->add(new AuthorizeCommandPlugin(), 'Payone/Authorize');
 $commandCollection->add(new CancelCommandPlugin(), 'Payone/Cancel');
 $commandCollection->add(new CaptureCommandPlugin(), 'Payone/Capture');
 $commandCollection->add(new CaptureWithSettlementCommandPlugin(), 'Payone/CaptureWithSettlement');
 $commandCollection->add(new RefundCommandPlugin(), 'Payone/Refund');

 return $commandCollection;
 });
```
In order to use the state machines provided by Payone module, make sure to add the location path to configuration:

```php
<?php
$config[OmsConstants::PROCESS_LOCATION] = [
 OmsConfig::DEFAULT_PROCESS_LOCATION,
 $config[KernelConstants::SPRYKER_ROOT] . '/payone/config/Zed/Oms'
];
```

Add Payone controller provider to Yves bootstrap (this is required to provide endpoint URL for transaction status callbacks) in `src/Pyz/Yves/Application/YvesBootstrap.php`.
```php
<?php
use Spryker\Yves\Payone\Plugin\Provider\PayoneControllerProvider;
 ...
 protected function registerControllerProviders()
 {
 ...
 $controllerProviders = [
 ...
 new PayoneControllerProvider($ssl),
 ];
```

Optionally configure security firewall for `/payone` route to accept `TransactionStatus` requests.
Excerpt from PAYONE Platform Channel Server API document:

    <br>
According to the configuration of your payment portal you will receive the data and the status for each payment processed via the URL you have submitted. The data transfer is based on simple HTTP-POST request (key/value pairs). The `TransactionStatus` is sent from the following IP addresses: 185.60.20.0/24 (i.e. 185.60.20.1 to 185.60.20.254). Please configure your firewall to allow incoming packets from these IP addresses.

To provide payment details for rendering on frontend, add Payone client to the Checkout and to the Customer module:

in `src/<project_name>/Yves/Checkout/CheckoutDependencyProvider.php`
```php<?php
...
class CheckoutDependencyProvider extends SprykerCheckoutDependencyProvider
{
 ...
 const CLIENT_PAYONE = 'CLIENT_PAYONE';
 ...
 protected function provideClients(Container $container)
 {
 ...
 $container[static::CLIENT_PAYONE] = function (Container $container) {
 return $container->getLocator()->payone()->client();
 };
 ...
 return $container;
 }
```

in `src//Yves/Customer/CustomerDependencyProvider.php`:
```php
<?php
...
class CheckoutDependencyProvider extends SprykerCheckoutDependencyProvider
{
 ...
 const CLIENT_PAYONE = 'CLIENT_PAYONE';
 ...
 protected function provideClients(Container $container)
 {
 ...
 $container[static::CLIENT_PAYONE] = function (Container $container) {
 return $container->getLocator()->payone()->client();
 };
 ...
 return $container;
 }
 ```

To add payment details on success step of checkout:

Add quote and payment details to template variables in `src/<project_name>/Yves/Checkout/Process/Steps/SuccessStep.php`

 Click to expand the code sample

 ```php
 <?php
...
use Generated\Shared\Transfer\PayoneGetPaymentDetailTransfer;
use Spryker\Client\Payone\PayoneClientInterface;
use Spryker\Yves\Payone\Handler\PayoneHandler;
...
class SuccessStep extends AbstractBaseStep
{
 ...
 /**
 * @var \Spryker\Client\Payone\PayoneClientInterface
 */
 protected $payoneClient;

 /**
 * @var \Generated\Shared\Transfer\QuoteTransfer
 */
 protected $quoteTransfer;
 ...
 public function __construct(CustomerClientInterface $customerClient, PayoneClientInterface $payoneClient, $stepRoute, $escapeRoute)
 {
 ...
 $this->payoneClient = $payoneClient;
 }
 ...
 public function execute(Request $request, AbstractTransfer $quoteTransfer)
 {
 $this->customerClient->markCustomerAsDirty();

 if (method_exists($quoteTransfer->getPayment(), 'getPayone')) {
 $this->quoteTransfer = $quoteTransfer;
 }

 return new QuoteTransfer();
 }
 ...
 /**
 * @param \Spryker\Shared\Kernel\AbstractTransfer $dataTransfer
 *
 * @return array
 */
 public function getTemplateVariables(AbstractTransfer $dataTransfer)
 {
 $getPaymentDetailTransfer = new PayoneGetPaymentDetailTransfer();
 if ($this->quoteTransfer->getPayment()->getPaymentProvider() === PayoneHandler::PAYMENT_PROVIDER) {
 $getPaymentDetailTransfer->setOrderReference($this->quoteTransfer->getOrderReference());
 $getPaymentDetailTransfer = $this->payoneClient->getPaymentDetail($getPaymentDetailTransfer);
 }
 return [
 'quoteTransfer' => $this->quoteTransfer,
 'paymentDetail' => $getPaymentDetailTransfer->getPaymentDetail(),
 ];
 }
```

Inject Payone client into the step factory `src/<project_name>/Yves/Checkout/Process/StepFactory.php`
```php
<?php
...
protected function createSuccessStep()
{
 return new SuccessStep(
 $this->getProvidedDependency(CheckoutDependencyProvider::CLIENT_CUSTOMER),
 $this->getProvidedDependency(CheckoutDependencyProvider::CLIENT_PAYONE),
 CheckoutControllerProvider::CHECKOUT_SUCCESS,
 ApplicationControllerProvider::ROUTE_HOME
 );
}
```

To add payment details on order details page in customer cabinet:

Add method that will create the Payone client into the CustomerFactory `src/<project_name>/Yves/Customer/CustomerFactory.php`:

```php
<?php
...
class CustomerFactory extends AbstractFactory
{
 ...
 /**
 * @return \Spryker\Client\Payone\PayoneClientInterface
 */
 public function createPayoneClient()
 {
 return $this->getProvidedDependency(CustomerDependencyProvider::CLIENT_PAYONE);
 }
```

Add payment details to template variables inside the OrderController in `src/<project_name>/Yves/Customer/Controller/OrderController.php`:

```php
<?php
...
use Generated\Shared\Transfer\PayoneGetPaymentDetailTransfer;
...
class OrderController extends AbstractCustomerController
{
 ...
 protected function getOrderDetailsResponseData($idSalesOrder)
 {
 ...
 $getPaymentDetailTransfer = new PayoneGetPaymentDetailTransfer();
 $getPaymentDetailTransfer->setOrderId($idSalesOrder);
 $getPaymentDetailTransfer = $this->getFactory()
 ->getPayoneClient()->getPaymentDetail($getPaymentDetailTransfer);

 return [
 'order' => $orderTransfer,
 'paymentDetail' => $getPaymentDetailTransfer->getPaymentDetail(),
 ];
 }
```
---

## Copyright and Disclaimer

See [Disclaimer](https://github.com/spryker/spryker-documentation).

---
For further information on this partner and integration into Spryker, please contact us.

<div class="hubspot-forms hubspot-forms--docs">
<div class="hubspot-form" id="hubspot-partners-1">
            <div class="script-embed" data-code="
                                            hbspt.forms.create({
				                                portalId: '2770802',
				                                formId: '163e11fb-e833-4638-86ae-a2ca4b929a41',
              	                                onFormReady: function() {
              		                                const hbsptInit = new CustomEvent('hbsptInit', {bubbles: true});
              		                                document.querySelector('#hubspot-partners-1').dispatchEvent(hbsptInit);
              	                                }
				                            });
            "></div>
</div>
</div>
