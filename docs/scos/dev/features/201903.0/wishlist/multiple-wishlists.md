---
title: Multiple Wishlists
description: Help your customers track and save items for later purchase through multiple Wish Lists, which are connected to the users' accounts.
originalLink: https://documentation.spryker.com/v2/docs/multiple-wishlists
originalArticleId: 536e3ae9-8662-4da8-82bc-cc898e89f39f
redirect_from:
  - /v2/docs/multiple-wishlists
  - /v2/docs/en/multiple-wishlists
---

Help your customers track and save items for later purchase through multiple Wishlists, which are connected to the users' accounts.

Customers can create one or multiple wishlists with [different names](/docs/scos/dev/features/201903.0/wishlist/named-wishlists.html), add products to them and [transfer wishlists to carts](/docs/scos/dev/features/201903.0/wishlist/convert-wishlist-to-cart.html) (either the entire list, or a specific item from the list)

Customers can manage their wishlists in the **Wishlist** section of the customer account.

In the **Wishlist** section, your customers can see the list of wishlists that they have, the number of items inside each one, the date of creation, **Edit** and **Delete** options.
![Multiple wishlists](https://spryker.s3.eu-central-1.amazonaws.com/docs/Features/Wishlist/Multiple+Wishlists/multiple_wishlists.gif){height="" width=""}

Your users can add items from different lists to the cart.

{% info_block warningBox %}
Note that if the same item is added to the cart from multiple wishlists, then in the cart this item will have the quantity value updated based on the number of times this specific item was added.<br>Each wishlist is an independent entity.
{% endinfo_block %}