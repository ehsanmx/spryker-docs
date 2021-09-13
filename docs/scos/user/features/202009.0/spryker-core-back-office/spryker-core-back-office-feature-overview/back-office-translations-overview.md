---
title: Back Office translations overview
description: Back Office Translations feature allows a user with administrative rights to translate the Back Office into different languages in a per-user manner.
originalLink: https://documentation.spryker.com/v6/docs/back-office-translations-overview
originalArticleId: 526f3da4-95c2-4dcf-b552-54ac358eab12
redirect_from:
  - /v6/docs/back-office-translations-overview
  - /v6/docs/en/back-office-translations-overview
---

The Back Office Translations feature introduces a way to translate the Administration interface (Zed) into different languages in a per-user manner. In terms of hierarchy, only the user with administrative rights who has access to User Control section of Zed, can manage the feature. For example, a team of developers might include a French and a German. In this case, the Shop Administrator might set up French and German Zed translations for their accounts accordingly, and those translations wouldn't interfere with each other.

There are two ways to assign a language to a user account: from the Create new User page of the User Control>User section or from the Edit User page of User Control>User section if the user is already created. Once the account language is changed, the respective user will see that their interface is translated into the corresponding language upon their next login.

Translations are added by means of uploading .csv extension files to the folders of the target modules - `data/translation/Zed/{ModuleName}/{locale_code}.csv`

File name examples can be found below:

* `en_US.csv`
* `en_UK.csv`
* `de_DE.csv`
* `fr_FR.csv`

Once a new translation file is uploaded, regenerate translation cache to reflect the changes by running the following commands:

```
translator:clean-cache
translator:generate-cache
```

Each file should consist of _key_ and _translation_ columns without headers. Example:


|  |  |
| --- | --- |
| Add Group | Gruppe hinzufügen |
| Add new Role | Neue Rolle hinzufügen |
| Add Rule | Regel hinzufügen |

{% info_block warningBox %}
If a translation is missing, the corresponding key is displayed instead.
{% endinfo_block %}

Unlike _Glossary_ section of Zed which is used for managing Front-end(Yves) translations, there is no interface for managing Zed translations currently. All the translations are managed by updating corresponding .csv files directly. Similarly to uploading translation files, you need to regenerate translation cache to reflect the changes after updating them. Use the commands to do that.

Newly created and all the existing modules are shipped with German translation by default. If you want to add a different language, you can follow the instructions from the [Back Office translations feature integration guide](/docs/scos/dev/migration-and-integration/202009.0/feature-integration-guides/spryker-core-back-office-feature-integration.html).

The scheme below illustrates relations between Translator, UserExtension, User, UserLocale and UserLocaleGui modules:

![image](https://spryker.s3.eu-central-1.amazonaws.com/docs/Features/Back+Office/Back+Office+Translations/Back+Office+Translations+Feature+Overview/module-diagram.png)


## If you are:

<div class="mr-container">
    <div class="mr-list-container">
        <!-- col1 -->
        <div class="mr-col">
            <ul class="mr-list mr-list-green">
                <li class="mr-title">Developer</li>
                <li><a href="docs\scos\dev\migration-and-integration\202009.0\feature-integration-guides\spryker-core-back-office-feature-integration.md" class="mr-link">Enable Back Office translations by integrating the Spryker Core Back Office feature into your project</a></li>
            </ul>
        </div>
      <!-- col2 -->
        <div class="mr-col">
            <ul class="mr-list mr-list-blue">
                <li class="mr-title">Back Office User</li>
                <li><a href="docs\scos\user\user-guides\202009.0\back-office-user-guide\users\roles-groups-and-users\managing-users.md#creating-users" class="mr-link">Assign language to a Back Office user</a></li>
            </ul>
        </div>  
</div>
</div>