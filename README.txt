=== Plugin Name ===
Contributors: levdbas
Tags: time, hours, tracking, client, pre-paid
Requires at least: 3.0.1
Tested up to: 4.9
Stable tag: 1.4.2
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
1. Dashboard widget, visible for all roles highter then editor. Animated by css and js. The table shows the last five activities.
2. Settings page where you can set your E-mail adress. Amount of bought hours and input the activities with a date, description and the time spent.
3. Overview page where all activities are listed.

== Changelog ==
= 1.4.2 =

* Tested up to version 4.9
* Updated .pot file
* Added screenshots
* Switched to multi sass files for css
* Some extra refactoring

= 1.4.1 =
Thank you [Jos Klever](https://wordpress.org/support/users/josklever/) for reviewing the plugin.

bugs fixed:

* link to setup page on plugin overview is fixed.
* better check on the $workFields array if it is really empty.

enhancements:

* code refactoring, reusing code from widget page on overview page
* and thus using the same feedback flow from the widget on the overview page.
* add extra feedback when there are no work activities filled in. Providing a button to the settings page as well.


= 1.4 =

new:

* new menu setup
   * main page with dashicon
   * overview page with all entries
  * settings page with that originally was located under settings
* better access control to widget and buttons

Enhancements:

* made the hour wheel more responsive
* code refactoring by splitting code over multiple partials.
* new translations
* UI is more consistant with WordPress in general.

Bugs fixed:

* fixed a bug where entering more then 24h on bought/used gave an error
* fixed a bug where when deactivating the plugin, all data was lost
   * all data will be removed on plugin removal.

= 1.3.3 =
* removed some unnecessary fields
* Extra checks around fields to remove php notices
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
