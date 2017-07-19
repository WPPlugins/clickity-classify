<?php
/**
 * Plugin Name: Clickity Classify
 * Plugin URI: https://github.com/ajschlosser/clickity-classify/
 * Description: Automatically adds (and/or removes) custom CSS classes to clicked DOM elements
 * Version: 0.0.21
 * Author: Aaron John Schlosser
 * Author URI: http://www.aaronschlosser.com
 * License: GPL2
 */
/*
Clickity Classify automatically adds (and/or removes) custom CSS classes to clicked DOM elements.
Copyright (C) 2014 Aaron John Schlosser (email: aaron@aaronschlosser.com)

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

defined("ABSPATH") or die("No script kiddies please!");
add_action("admin_menu", "cc_create_menu");
function cc_create_menu() {
    add_menu_page("Clickity Classify", "Clickity Classify", "administrator", __FILE__, "cc_settings_page");
    add_action( "admin_init", "register_ccsettings" );
}
function register_ccsettings() {
    register_setting( "cc-settings-group", "cc_class" );
    register_setting( "cc-settings-group", "cc_clicked" );
}
function cc_settings_page() {
?>
	<div class="wrap">
	<h2>Clickity Classify</h2>
	<p>
		Clickity Classify looks for elements with a special class name ("cc-class" by default), and then adds a JavaScript on-click event listener to them. When clicked, Clickity Classify will add (or remove) a custom CSS class ("cc-clicked" by default). You can then add transitions, animations, etc. to this class in your CSS file(s).
	</p>
	<form method="post" action="options.php">
	    <?php settings_fields( 'cc-settings-group' ); ?>
	    <?php do_settings_sections( 'cc-settings-group' ); ?>
	    <table class="form-table">
	        <tr valign="top">
	        <th scope="row">Class Name to Add Click Event To (default = "cc-class")</th>
	        <td><input type="text" name="cc_class" value="<?php echo get_option('cc_class'); ?>" class="full" /></td>
	        </tr>
	        <tr valign="top">
	        <th scope="row">Class Name to Be Added (or Removed) Triggering of Click Event (default = "cc-clicked")</th>
	        <td><input type="text" name="cc_clicked" value="<?php echo get_option('cc_clicked'); ?>" class="full" /></td>
	        </tr>
	    </table>
	    <?php submit_button(); ?>
	</form>
	</div>
	<style>
	    .full {
	        width: 95%;
	    }
	</style>
<?php
}

function clickity_classify () {
?>
	<script>
		function classify(evt) {
			var e = evt.currentTarget.nextSibling;
			while (e.nodeType != Node.ELEMENT_NODE) e = e.nextSibling;
			if (e.className.indexOf("<?php echo get_option("cc_clicked") ?>") != -1) e.classified = true;
			if (!e.classified) {
				e.classList.add("<?php echo get_option("cc_clicked") ?>");
				e.classified = true;
			} else {
				e.classList.remove("<?php echo get_option("cc_clicked") ?>");
				e.classified = false;
			}
		}
		var clickity = document.getElementsByClassName("<?php echo get_option("cc_class") ?>");
		for (var i = 0; i < clickity.length; i++) {
			clickity[i].addEventListener("click", classify);
		}
	</script>
<?php
}
function clickity_classify_init() {
    if (!get_option("cc_clicked")) update_option("cc_clicked", "cc-clicked");
    if (!get_option("cc_class")) update_option("cc_class", "cc-class");
}
register_activation_hook( __FILE__, 'clickity_classify_init' );
add_action( "wp_footer", "clickity_classify" );




