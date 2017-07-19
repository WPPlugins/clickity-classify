=== Clickity Classify ===
Contributors: ajschlosser
Tags: click,onclick,class,classes,javascript,dom,element,add,css,remove,style,styles
Requires at least: 3.9.1
Tested up to: 3.9.1
Stable tag: 0.0.21
License: GPL2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Automatically adds (and/or removes) custom CSS classes to DOM elements when certain elements are clicked. Makes JavaScript onclick and onclick-style events trivial.

== Description ==
Clickity Classify automatically adds (and/or removes) custom CSS classes to DOM elements when certain elements are clicked, making JavaScript onclick and onclick-style events trivial. It looks for elements with a special class name ("cc-class" by default), and then adds a JavaScript on-click event listener to them. When clicked, Clickity Classify will add (or remove) a custom CSS class ("cc-clicked" by default) to the next-closest element. You can then add transitions, animations, etc. to this class in your CSS file(s). This is especially handy for dropdown menus.

== Installation ==
Add the plugin to your WordPress installation. That's it. It will automagically work with any element with the class "cc-class" (or any custom class name you provide on the settings page).

== Changelog ==

= 0.0.1 =
* So it begins...

= 0.0.2 =
* Add support for pre-classed elements

= 0.0.21 =
* Whoops, fix world-breaking bug

== Upgrade Notice ==

= 0.0.21 =
* Please install or update to this version; previous versions contain a big bad bug