---
title: Using a Facade
description: This article describes the cases when the facade is used.
originalLink: https://documentation.spryker.com/v5/docs/using-facade
originalArticleId: 51a912c9-2e40-4583-80b7-b34e4b3347c3
redirect_from:
  - /v5/docs/using-facade
  - /v5/docs/en/using-facade
---

## Using the Facade from a Controller or a Plugin

In Zed’s communication layer the facade of the same module is available with the `getFacade()` method from all controllers and plugins.
![image](https://spryker.s3.eu-central-1.amazonaws.com/docs/Developer+Guide/Zed/Business+Layer/How+to+Use+a+Facade/how-to-use-a-facade-from-the-same-bundle.png){height="" width=""}

A typical usage from a controller looks like this. The controller retrieves data from a submitted form and calls a method of a facade to save it.

```php
<?php
namespace Pyz\Zed\Glossary\Communication\Controller;

class FormController extends AbstractController
{
    public function translationAction()
    {
        // ...
        if ($form->isValid()) {
            $translation = new TranslationTransfer();
            $translation->fromArray($form->getRequestData());
            $this->getFacade()->saveTranslation($translation);
        }
        // ...
    } 
```

## Using a Facade from Another Module

To connect modules you can provide the facade to another module. To do so, you need to use the dependency provider mechanism.