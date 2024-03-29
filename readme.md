Clear Cache for Timber
======================

> Contributors: ogrosko, columbian-chris
>
> Donate link:
>
> Tags: cache, clear, flush, twig, Timber
>
> Requires at least: 2.0.1
>
> Tested up to: 6.4.2
>
> Stable tag: 6.4
>
> License: GPLv2 or later
>
> License URI: http://www.gnu.org/licenses/gpl-2.0.html

## Description

Small Wordpress plugin for flushing cache of Timber (Twig Template Plugin for Wordpress)

## Installation

1. Clone/download and upload the plugin files to the `/wp-content/plugins/` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. See new button in top panel "Clear Timber Cache" in the admin side


## Screenshots

![Alt text](/assets/screenshot-1.png?raw=true "Screenshot of plugin")

## Changelog

### 0.2.0 (21-12-2023)

Other:

  - compatibility with Timber 2.0 (thanks to columbian-chris)

### 0.1.0 (7-06-2016)

Features:

  - Added Wordpress cron job for daily cache clearing (use `define('CLEAR_CACHE_FOR_TIMBER_DISABLE_CRON_JOB_CLEANUP', true);` for disable)

### 0.0.6 (19-05-2016)

Fixes:

  - Compatibility fix with Timber v1.0.*

### 0.0.5 (27-04-2016)

Fixes:

  - Fixed bug with clearing cache from FE admin bar

Other:

  - Added markdown README for Github (thanks to @DesignyourCode)
  - Loader style finetuning


### 0.0.4 (11-03-2016)

Features:

  - Cleanup - Some cleanup tasks
