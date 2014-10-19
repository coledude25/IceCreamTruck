=== Space Boxes ===
Contributors: nphaskins
Donate link: http://nickhaskins.co/products/space-boxes/
Tags: galleries, grid, shortcodes, info boxes, content boxes, boxes, lightbox
Requires at least: 3.5
Tested up to: 3.8
Stable tag: 1.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Generate unlimited boxes with multiple layouts and optional lightbox, solely from a Wordpress media gallery.

== Description ==

Space Boxes (not Space Balls) was designed to make building content & media grids quick and painless. Each Space Box set is created solely with a Wordpress gallery inserted into a custom post type. When you insert the shortcode `[spaceboxes id=XX”]` , it will display the title, and caption for each image, if they are provided. 

Have 7 images in your gallery? Then you’ll have 7 boxes. Want a lightbox? No problem. Control over the grid? Check! There’s even a portfolio mode to show off images or product screenshots. You can also use the gallery to drag and drop your boxes in the order that you want them displayed. Woop! Hit the demo link below to see it in action.

* [http://space-boxes.nickhaskins.co/](http://space-boxes.nickhaskins.co/)


= Custom Post Type = 
Create multiple Space Box sets and manage them ease. Space Boxes even provides the shortcode for you with the post ID included for easy copy pasta.

= Design Control = 
You’ve got full control over the colors, and design of Space Boxes. There’s also shortcode attributes to control the size, and crop of the images.

= Multiple Options =
Space Boxes is packed full of options in the shortcode which allows it to be super versatile in it’s use.

= How to use the shortcode =

To display a Space Box set, use the following shortcode anywhere. The Space Boxes tab, will always show the available shortcode with the ID of the Space Box included for convenience.

`[spaceboxes id=“”]`

id=“” – pass the ID of the Space Box set

columns=“” – specify how many columns of items there should be. acceptable values include numbers 1-12. default is 4

itemcolumns=“” – specify how many columns each item should take up, based on a 12 column grid. default is 3

lightbox="on” – set this to on to open each image in a lightbox. default is off

size=“” – specify the size of each image. There are cropped, and non-cropped sizes. default is spacebox-small . additional attributes include spacebox-small-nocrop,spacebox-medium, & spacebox-medium-nocrop

layout="pinterest” – set to pinterest to enable grid layout. default is stacked

pinwidth=“” – only applies if using pinterest layout. specifies the width of each item. default is 300. you can also enter a percentage like '50%' . notice the single quotes, they are important when passing percentage value

pinspace=“” – only applies if using pinterest layout. specifies distance between pins. default is 5


= Space Box Archive Shortcode =

`[spaceboxes_archive]`

There are a few attributes available for the Space Box archive shortcode.

category=“” – specify a Space Box category name like awesome

columns=“” – specify how many columns of items there should be. acceptable values include numbers 1-12. default is 4

itemcolumns=“” – specify how many columns each item should take up, based on a 12 column grid. default is 3


= Filters =
`space_boxes_output` – filters the single Space Box output
`space_boxes_archive_output` – filters the archive output of Space Boxes

= Action Hooks =
`spacebox_before`
`spacebox_after`
`spacebox_inside_top`
`spacebox_inside_bottom`

`spacebox_archive_before`
`spacebox_archive_after`
`spacebox_archive_inside_top`
`spacebox_archive_inside_bottom`

= Further =
* Nick on [Twitter](http://twitter.com/nphaskins)
* Nicks [Store Updates](http://twitter.com/nhstoreupdates) feed

== Installation ==

How to Install Space Boxes

1. download and unzip the file
2. upload space-boxes to wp-content/plugins directory
3. activate the plugin, and enter your license under Space Boxes–>License to enable automatic updates
4. set any additional options under the Space Boxes tab within your wordpress admin

Space Box Creation

1. create a new Space Box set under the Space Box tab in WordPress
2. create and insert a wordpress gallery
3. Space Boxes will use the title, and the caption, if you fill them out
4. publish the set, and use the shortcode to display anywhere

== Frequently Asked Questions ==

= What types of things can I use this for? =

Space Boxes are super versatile. A few use cases include an image portfolio, screen shot gallery, or information hub.


== Screenshots ==

1. Default and pinterest modes
2. How to manage Space Boxes as a custom post type
3. Design controls
4. Shortcode attributes

== Changelog ==

= 1.1.1 =
* Actually add the gallery field fuel. Still getting used to Wordpress SVN sorry!

= 1.1 =
* Added the ability for you to link individual images to anywhere. A new “Link Field” was added to the Media Library modal (right under where you enter the captions at). If you fill out a link, it will override the lightbox if you have it set. If you don’t fill out a link, nothing happens. Seamless upgrade from 1.0.

= 1.0 =
* Initial Release

== Upgrade Notice ==

= 1.0 =
* Initial Release

