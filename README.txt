=== Plugin Name ===
Contributors: levdbas
Tags: time, hours, tracking, client, pre-paid
Requires at least: 3.0.1
Tested up to: 4.8
Stable tag: 1.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

 The support-hours plugin can be used to give your customers insight on the status of their pre-paid support hours.

== Description ==

Many webdevelopers offer pre-paid hours to their customers to maintain their websites. It can be a long wait for both the developers and the customer to find out how many hours are left to be spent on maintenance work.
This plugin makes this process much easier by displaying the hours bought and left directly in a dashboard widget.

The amount of bought hours and used hours with a description and date can be set on the settings page. After the first activation you need to set the support hour managers.
These accounts can only access the management page, so no sudden changes in the hours you've set.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload .zip to the `/wp-content/plugins/` directory or download via plugin manager
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Configure plugin under 'settings' in the admin dashboard.
4. See the admin widget displayed on your dashboard.

== Frequently Asked Questions ==

= Why did you create this plugin? =

To help my customers keep track of their pre-paid hours.

= Do you have plans to work on new functions for the plugin? =

Yes! I just added some new functionality to set different work entries. I will look into new functions on request or when I need something myself.

= Is this your first plugin? =

Yes! Feel free to sent me any suggestions or feedback. I think this plugin can be optimized quite a lot!

== Screenshots ==


== Changelog ==
= 1.3.3 =
* removed some unnecessary fields
* Extra checks around fields to remove php notices
= 1.3.2 =
* Checked up to version 4.8
* Removed notice
= 1.3.1 =
* Fixed a bug where an empty field row was not repeatable.
= 1.3.0 =
* Multiple work entries can now be added to the system and are shown in the dashboard widget. All time entries are calculated together to give a quick overview on the amount of hours left.
* Added a notice to set the old amount of hours in the new system.
* Updated the styling more towards the standard WP UI.
= 1.2.1 =
* Updated Description in plugin
* Fixed circle showing up at 0
= 1.2.0 =
* Moved to a new way to visualize the circle diagram.
* Circle diagram is now more responsive
* Minified css admin file
= 1.1.1 =
* Fix for error when no user is set
* When no user is set the dashboards widget will set a link to the plugin setup page.
= 1.1.0 =
* Ability to set more than one Support Hour manager.
* More consistent use of plugin name

= 1.0.4 =
* Dynamically scale circle-diagram via some javascript and css
* Added setup link when widget isn't configured yet.
* Fixed scaling/overflowing issues due to translations.

= 1.0.3 =
* Removed unnecessary style and javascript file
= 1.0.2 =
* Fix versioning number
= 1.0.1 =
* Fix in displaying text.
* Fix for displaying widget while being not configured.

= 1.0 =
* First commit of my plugin
