=== Clear cache for Timber ===
Contributors: ogrosko
Donate link:
Tags: cache, clear, flush, twig, Timber
Requires at least: 2.0.1
Tested up to: 4.5.2
Stable tag: 4.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Small Wordpress plugin for flushing cache of Timber (Twig Template Plugin for Wordpress)

== Installation ==

1. Clone/download and upload the plugin files to the `/wp-content/plugins/` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. See new button in top panel "Clear Timber Cache" in the admin side


== Screenshots ==

1. Clear cache for Timber in Wordpress

== Changelog ==

= 0.1.0 - 7/06/2016 =
* Added Wordpress cron job for daily cache clearing (use define('CLEAR_CACHE_FOR_TIMBER_DISABLE_CRON_JOB_CLEANUP', true); for disable)


= 0.0.6 - 19/05/2016 =
* Compatibility fix with Timber v1.0.*

= 0.0.5 - 27/04/2016 =
* Fixed bug with clearing cache from FE admin bar
* Added markdown README for Github (thanks to @DesignyourCode)
* Loader style finetuning

= 0.0.4 - 11/03/2016 =
* Cleanup - Some cleanup tasks