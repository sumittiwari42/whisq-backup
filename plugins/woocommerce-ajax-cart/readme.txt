=== WooCommerce Ajax Cart Plugin ===
Contributors: moiseh, el.severo
Tags: woocommerce, ajax, cart, shipping
Requires at least: 4.2
Tested up to: 4.7.4
Stable tag: 1.2.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

WooCommerce AJAX Cart plugin is a WordPress Plugin that changes the default behavior of WooCommerte Cart Page, allowing a buyer to see the Total price calculation when change the Quantity of a product, without need to manually click on "Update cart" button.

This improves the user experience when purchasing a product. No other hacks/code/theme changes is needed, this functionality is added when the plugin is activated.

[youtube https://www.youtube.com/watch?v=nXUjO2cGljs ]

Need some paid customisation feature or specific bug fix? Please send me a message: https://codecanyon.net/user/moiseh

== Installation ==

1. Upload `woocommerce-ajax-cart.zip` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Done. This plugin no requires extra configurations to work

== Screenshots ==

1. When user clicks on "+" or "-" of Quantity field, an AJAX request was made to update the prices.

== Changelog ==

= 1.0 =
* Initial version

= 1.1 =
* Remove product from cart automatically (AJAX) when changes quantity to zero

= 1.2 =
* Updated to work with Woocommerce 2.7
* Added "-" and "+" buttons in order to facilitate product quantity change on cart
* Added confirmation message when user selects the product quantity as zero
* Added option to display item quantity as select for better usability
* Update order totals when the cart is inside checkout page

= 1.2.1 =
* Fixed on change trigger for quantity field, on checkout page.
* Fixed event lost when remove or delete product from the cart

= 1.2.2 =
* Added translation support for most common terms
* Fixed broken dependencies on admin

== Frequently Asked Questions ==

== Upgrade Notice ==
