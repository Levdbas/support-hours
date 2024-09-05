=== Support Hours ===
Contributors: levdbas
Tags: support, hours, tracking, client, pre-paid,
Requires at least: 4.6
Tested up to: 6.6.0
Stable tag: 2.2.2
Requires PHP: 7.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Use Support hours to give yourself and your clients insights on the status of pre-paid work.

== Description ==

Small development task can have a huge impact on your time as a developer. How much time did your customer bought, how much time did you spent on tasks, how much time do you have left to spent? Not to mention all the effort to report it all back to your customer, every time you do something for them.
No more with Support Hours. Support Hours offers a simple interface for you, the web professional, to add pre-paid hours, log spent time and give a beautiful overview to your customer of how much time they have left. It even notices when the support hours are almost spent.
Free yourself from all the hassle around development support and try Support Hours now.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload .zip to the `/wp-content/plugins/` directory or download via plugin manager
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Configure plugin under 'settings' in the admin dashboard.
4. See the admin widget displayed on your dashboard.

== Frequently Asked Questions ==

= Why did you create this plugin? =

To help you and your customers keep track of pre-paid support hours and on what activities the time has been spend.

= Do you have plans to work on new functions for the plugin? =

Yes! I just released a very big update and I'm planning to iterate on it! Hopefully not another year will pass.

= Is this your first plugin? =

Yes! Feel free to sent me any suggestions or feedback. I think this plugin can be optimized quite a lot!

== Screenshots ==
1. Dashboard widget, visible for all roles higher then editor. Animated with css and js. The table shows the last five activities.
2. Settings page where you can set your E-mail address and add time entries with bought and spent time with a date and description
3. Overview page where all activities are listed.

== Changelog ==

= 2.2.2 =
* Fix two minor issues in README.TXT
* Fix automatic deployment workflow on GitHub

= 2.2.1 =
* Compatibility check with new WP version

= 2.2.0 =
* Compatibility check with new WP version
* Fixed a bug where overusage wasn't calculated correctly.
* Fixed a bug where you could not save the settings when you didn't added the first timeslot.

= 2.1.0 =
* Update minimal php version to 7.4
* Refactored classes so the plugin only does the calculations when loading a backend page.

= 2.0.0 =
* Complete rework of plugin.
* Removed outdated css framework in favor of vanilla css.
* Plugin is now compatible with latest WordPress security standards.
* Bug fixed: Fixed PHP error.



= 1.8.0 =
* New: Removed jQuery from build.
* New: Time and date inputs now use proper input forms. 
* New: Dates are now translated and displayed following your WordPress settings. 
* New: Materialize.css datepicker is ditched in favor of browser native input fieds.
* New: Function that converts the old dd-mm-yyyy from the workfields to the new yy-mm-dd format to be used with the default time input fields.
* Bug fixed: removed extra comma after e-mail address in mailto button.
* Compatibility check with new WP version

= 1.7.1 =
* Fixes rare case where jQuery UI datepicker took over the materialize.css datepicker.

= 1.7.0 =
* Namespace plugin PHP files.
* Compatibility check with new WP version
* Compatibility check with PHP 8
* Fix jQuery deprecations
* Code cleanup
* Add proper uninstall hook
* Fix notices after installation

= 1.6.2 =
* Compatibility check with new WP version
* js/css update

= 1.6.1 =
* Use correct colors in notices.
* Other minor fixes.

= 1.6.0 =
* Updated widget to use circle svg instead of overlapping divs. Widget animation should now be a lot smoother.
* Notices in plugin now use an uniform function.

= 1.5.7 =
* Checked against WordPress 5.3
* Minor fixes
* Prepairing for further development

= 1.5.6 =
* Fixed another issue where the plugins Javascript would interfere with Divi theme.
* Made the overall js package a lot smaller.
* New build stack added based on Webpack 4.
* Checked up to WP 5.1.1

= 1.5.5 =
* Fixed an issue where other css would get overruled by support-hours css
* Fixed an issue where the plugins Javascript would interfere with Divi theme.

= 1.5.4 =
* Fixed widget circle percentage when multiple times hours were added
* Fixed total time issue in the widget output.

= 1.5.3 =

* Updated readme
* Fixed a redeclare php error when saving the time fields
* Enhanced build package
* Fixed color scheme not loading for the circle animation
* Worktable in the widget now shows the last five entries instead of the first five
* Better responsive behavior
* Updated plugin screenshots, readme and logo

= 1.5.2 =

* order activities on data at saving.
* removed time transform function
* removed public side of plugin for a smaller package
* update to notices and errors if thrown.

= 1.5.1 =

* Fixed the issue where adding a new time entry caused all other entries to have the same date. Thank you [Ivar](https://wordpress.org/support/users/donquicky/) for reporting the bug!
= 1.5 =

New:

* Changed the working of the amount of bought hours. Instead of one fixed number of all the hours, you can add new time over time.
* Complely new UI on the settings page which now features material design modals.
* Introducting a temporary function that changes some database related stuff to move to the new system.
* implemented new build tools for faster development flow.

Changed:

* Rework of all the functions under the hood
* Changed the way you input the work
* A lot of css and JS enhancements
* Updated strings and translations

Deleted:

* the fixed bought hours field is now gone

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
* better check on the $work_fields array if it is really empty.

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
