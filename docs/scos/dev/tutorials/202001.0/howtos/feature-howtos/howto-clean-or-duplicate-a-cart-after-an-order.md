---
title: HowTo - Clean or Duplicate a Cart after an Order
originalLink: https://documentation.spryker.com/v4/docs/howto-clean-or-duplicate-a-cart-after-an-order
originalArticleId: 7ca6bbaf-ff7e-45e7-afff-5f74b116b7c5
redirect_from:
  - /v4/docs/howto-clean-or-duplicate-a-cart-after-an-order
  - /v4/docs/en/howto-clean-or-duplicate-a-cart-after-an-order
---

You can define the behavior of carts so that the active cart is either cleaned, or duplicated and left as is after an order has been placed. 
To define the behavior, use CheckoutPageConfig:

`Pyz\Shared\CheckoutPage\CheckoutPageConfig`:
   
```
    /**
     * @api
     *
     * @return bool
     */
    public function cleanCartAfterOrderCreation()
    {
        return true;
    }
```

If the value is set to `true`, the **active** cart will be deleted after the order has been placed. 
If the value is set to `false`, the cart remains unchanged, i.e., not deleted.

