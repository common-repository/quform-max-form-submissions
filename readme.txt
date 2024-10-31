=== Quform Max Form Submissions ===
Contributors: adrian2k7
Tags: quform
Donate link: http://moewe.io/demo/
Requires at least: 4.0
Tested up to: 4.6
Stable tag: 1.0.1
License: GPL v3
License URI: http://www.gnu.org/copyleft/gpl.html

Quform Max Form Submissions allows you to define a max number of submissions for Quform forms.

== Description ==
Quform Max Form Submissions allows you to define a max number of submissions for [Quform](http://codecanyon.net/item/quform-wordpress-form-builder/706149?ref=scrobbleme) forms.

**Note** This plugin requires [Quform](http://codecanyon.net/item/quform-wordpress-form-builder/706149?ref=scrobbleme) to work.

**Features**

* Ability to define the max number of submissions for a Quform form.
  * When this number is reached the form will be disabled.
* Shortcode to show the remaining available submissions.
* Shortcode to show a text, when a form is disabled

**Usage**

Please see the [Other Notes](https://wordpress.org/plugins/quform-max-form-submissions/other_notes/) section for more details on this.

**Support**

Please use the [support forum](https://wordpress.org/support/plugin/quform-max-form-submissions) in case of any problems or questions before
just giving a bad rating. We really take this seriously.

== Installation ==
You can install the plugin in two ways:

= From within WordPress plugin installation (recommended) =

1. Search for "Quform Max Form Submissions"
1. Download and then active it.

or

= Upload and activate the file manually via FTP =

1. Download the plugin, extract the zip file.
1. Upload the folder "quform-max-form-submissions" to your /wp-content/plugins/ directory.
1. Active the plugin in the plugin menu panel in your administration area.

== Frequently Asked Questions ==

Please use the [support forum](https://wordpress.org/support/plugin/quform-max-form-submissions) to ask any questions.

== Upgrade Notice ==

Nothing special.

== Screenshots ==

Currently none.

== Usage ==

= Add max number of submissions to form =

1. Create a form using Quform
1. Add a "Hidden field"
  1. **(Important)** Name this field **max_number_of_submissions**,
  1. Set the number of submissions as "default value" for this field,
  1. (Recommended) Set the field to not be stored within the database.

= Shortcode: iphorm_remaining_entries =

This shortcode will output the number of remaining submissions as a number. If there is no limit the
infinity symbol (can be changed through translation) will be output.

The only parameter is "id", which is the forms id.

`[iphorm_remaining_entries id="1"]`

= Shortcode: iphorm_disabled_form =

This shortcode will output its content, when the given form is disabled.

`[iphorm_disabled_form id="1"]The form is disabled.[/iphorm_disabled_form]`

== Changelog ==

= 1.0.1 =

* Hopefully added everything needed for translation.

= 1.0.0 =

* Initial public release