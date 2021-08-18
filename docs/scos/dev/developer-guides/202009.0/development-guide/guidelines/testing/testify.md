---
title: Testify
description: On top of Codeception, Spryker built the Testify module, which provides many useful helpers
originalLink: https://documentation.spryker.com/v6/docs/testify
originalArticleId: bfecac4f-216e-4677-bc45-f792ce0e8a90
redirect_from:
  - /v6/docs/testify
  - /v6/docs/en/testify
---

On top of [Codeception](https://codeception.com), Spryker offers some classes to make your test life easier. In the Spryker [Testify](https://github.com/spryker/testify) module, you can find many useful  helpers.

The helpers provided within the Testify module let you write your tests way faster and with less mocking required. For the list of the most useful helpers from the Testify module, see [Testify Helpers](/docs/scos/dev/developer-guides/202009.0/development-guide/guidelines/testing/available-test-helpers.html#testify-helpers).

Spryker follows an [API test](/docs/scos/dev/developer-guides/202009.0/development-guide/guidelines/testing/testing-best-practices.html) approach to have more coverage with less test code. Testing through the API ensures that the underlying wireup code is working properly. With the helpers of the Testify module, you can avoid ending-up in the so-called "mocking hell". The "mocking hell" means that your test contains more mocks than real test code, which makes the test unreadable and hard to maintain.

Assume you want to test a Facade method. The underlying model which should be tested has dependencies to other models and/or to the module config. Inside the Facade method, you have to create the model through the factory, including its dependencies, and call a method on the created model.

Without the Testify module, you would need to create a test like this one:
```PHP
// Arrange
$dependencyMock = $this->createDependencyMock();

$factoryMock = $this->createFactoryMock();
$factoryMock->method('createDependency')->willReturn($dependencyMock);

$configMock = $this->createConfigMock(...);
$factoryMock->setConfig($configMock);

$facade = new XyFacade();
$facade->setFactory($factoryMock);

// Act
$result = $facade->doSomething();

// Assert
...
```
That would make your test method unreadable and hard to maintain.
Here is an example with the use of helpers:
```PHP
// Arrange
$this->tester->mockFactoryMethod('createDependency', $this->createDependencyMock());
$this->tester->mockConfigMethod('getFooBar', 'bazbat');

// Act
$result = $this->tester->getFacade()->doSomething();

// Assert
...

```
As you can see, this test is much smaller, easier to read, and better understandable. All the required injections of the mocks are made behind the scenes, and you can easily test what you want to.

## Next steps
* [Set up an organization of your tests](/docs/scos/dev/developer-guides/202009.0/development-guide/guidelines/testing/setting-up-tests.html).
* [Create or enable a test helper](/docs/scos/dev/developer-guides/202009.0/development-guide/guidelines/testing/test-helpers.html).
Learn about the [console commands you can use to execute your tests](/docs/scos/dev/developer-guides/202009.0/development-guide/guidelines/testing/executing-tests.html).



