=== DevriX Dark Site ===
Contributors: devrix, koki4a, edocev, smetodiew, metodiew, mmitrev
Tags: redirection, darksite, banner, notice
Requires at least: 4.4
Tested up to: 5.1.1
Stable tag: 0.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Plugin to use when something on the site is broken, not fully working, or worst case scenario - the whole site is down.

== Description ==

Unfortunately, sometimes features of a site are not working propperly- pages are not loading, payment systems are not working, etc.
We created this plugin with the idea of dealing with emergencies on the site. It has two major features:
	1. A redirection field, which when added URL to it will redirect the whole site to the URL for all non-logged users. For example, a pre-created page that informs the user that the site is under construction or down.
	2. A  WYSIWYG redactor, which renders a bar over the whole site in the header. The bar can have custom content in it and when closed a cookie is loaded for 12 hours. While the cookie is enabled the notice won't show for the user, but once the cookie expires the notice shows again.  This is added with the idea of informing the users that something is not working properly. For example "Sorry, our payment systems are not working at the moment".

== Installation ==

1. Upload `dx-dark-site` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Plugin settings page is located under Settings -> Dark Site
