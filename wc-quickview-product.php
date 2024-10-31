<?php
/*
Plugin Name: Quick View Products
Plugin URI: https://danielesparza.studio/quick-view-products/
Description: Quick View Products es un Plugin para WooCommerce que permite tener una vista previa de los productos desde la lista de productos. Este plugin hace uso de algunos recursos de bootstrap 4.0.0.
Version: 1.0
Author: Daniel Esparza
Author URI: https://danielesparza.studio/
License: GPL v3

Quick View Products
©2020 Daniel Esparza, inspirado por #openliveit #dannydshore | Consultoría en servicios y soluciones de entorno web - https://danielesparza.studio/

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

//global
$dewp_prefix = 'dewp_';
$dewp_plugin_name = 'Quick View Products';
$dewp_options = get_option( 'dewp_settings' );

//includes
include ( 'includes/wc-quickview-product-admin.php' );
include ( 'includes/wc-quickview-product-functions.php' );