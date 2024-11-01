=== Xstream Google Analytics for WordPress ===
Contributors: xstreamthemes
Tags: google analytics, tracking, light weight, simple, free, leverage browser, cache
Requires at least: 3.7.0
Tested up to: 4.8.1
Stable tag: 1.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Google Analytics for your Wordpress website with JS file completelly hosted locally for performance increase.


== Description ==

Track your WordPress website with Google Analytics service. JS file is completelly hosted locally for performance increase. Just add your tracking code inside settings page and that's it.

= Main features =

* light weight and very easy to use
* analytics.js file is stored locally
* eliminates leverage browser cache error


== Installation ==
0. Remove existing Google Analytics plugin or disable them.
1. Search for 'Xstream Google Analytics' in WordPress Plugin Directory and Download the .zip file & extract it.
2. Upload the folder `xstream-google-analytics` to the `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins List' page in WordPress Admin Area.
4. Configure this plugin via Settings-->Xstream Analytics
5. Login to Google Analytics account to view stats.


== Frequently Asked Questions ==


= What is different with this plugin ? =

WordPress plugin directory already filled with many of these kind of plugins.
But not all are optimized for performance. Also this plugin stores analytics.js file locally so you avoid leverage browser cache error inside google speed test.


= Tracking code not shown up in front end =

There may be several reasons for this.

* Make sure you have entered a valid tracking ID.
* Check if tracking is not disabled for current logged in user type.
* Try to flush/delete your site cache.
* Try re-installing the plugin.


= What if i uninstall/remove this plugin? =

No worry! It will remove its traces from database upon uninstall.
It will also disable tracking by removing the code from front-end.

= Where to find my GA Tracking ID ? =

Just go [here](https://support.google.com/analytics/answer/1032385).

= Did you test it with old version of WordPress ? =

I uses latest version WordPress during development.
So i recommend you to upgrade to latest WordPress today.


== Upgrade Notice ==


== Changelog ==


= 1.0.1 =
* Release date: August 5, 2017
* Release note: Minor fixes to readme file and header images

= 1.0.0 =
* Release date: August 5, 2017
* Release note: First release


== Other Notes ==

PHP version 7.0 is recommanded.
