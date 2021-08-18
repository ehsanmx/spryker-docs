---
title: HowTo - Notify About Unsupported Browsers
originalLink: https://documentation.spryker.com/v5/docs/howto-notify-about-unsupported-browsers
originalArticleId: 3ae44b7e-03b0-4383-8aa0-1ec99b0224c4
redirect_from:
  - /v5/docs/howto-notify-about-unsupported-browsers
  - /v5/docs/en/howto-notify-about-unsupported-browsers
---

To notify your users about an unsupported browser, you can use our `unsupported-browser-popup` component. The component is not provided out of the box, download it:
@(Embed)(https://cdn.document360.io/9fafa0d5-d76f-40c5-8b02-ab9515d3e879/Images/Documentation/unsupported-browser-popup.zip)

In our example, the component checks `userAgent` for Internet Explorer browsers by the inline script. If the component detects the Internet Explorer browser, it displays a message. 

The component can also be changed to detect a feature, for example:

```PHP
var hasNativeCustomElements = !!window.customElements;
```
## Usage
To make use of the `unsupported-browser-popup` component, add it to the molecules of the **ShopUi** module and include in the current `page-blank` template in the `body` tag before script bundles. By default, the script bundles reside in the `footerScripts` block.

Example:
```PHP
{% raw %}{%{% endraw %} include molecule('unsupported-browser-popup') only {% raw %}%}{% endraw %}
```
{% info_block infoBox %}

Our example supports IE 9+ browsers.

{% endinfo_block %}