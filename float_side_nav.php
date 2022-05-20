<?php
/*
Plugin Name: Float Side Nav
Plugin URI: http://wpdev.net/fsn
Description: Create a menu in wordpress and have that float on the side of your site
Version: 2.0.1
Author: Ciprian Tepes
Author URI: http://wpdev.net
License: GPL
*/
/*  Copyright 2014 Ciprian T  (email : cipriant@kompanigroup.com)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as 
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

//require_once dirname( __FILE__ ) . '/XTeam_Nav_Menu_Item_Custom_Fields.php';

if ( ! class_exists( 'Menu_Item_Custom_Fields' ) ) :
	/**
	 * Menu Item Custom Fields Loader
	 */
	class Menu_Item_Custom_Fields {

		/**
		 * Add filter
		 *
		 * @wp_hook action wp_loaded
		 */
		public function __construct() {

//			add_filter( 'wp_edit_nav_menu_walker', array( __CLASS__, '_filter_walker' ), 99 );
			register_nav_menu( 'side-float-menu', 'Side Float Menu' );
//			var_dump( $screen );
			add_action( 'admin_enqueue_scripts', array( __CLASS__, 'load_color_picker' ) );
		}

		public static function load_color_picker() {

			$menu_name = 'side-float-menu';
			$locations = get_nav_menu_locations();
			$menu_id   = $locations[ $menu_name ];
//			var_dump( wp_get_nav_menu_object( $menu_id ) );

			if ( get_current_screen()->id == 'nav-menus' ) {

//			wp_enqueue_style( 'wp-color-picker' );
				wp_enqueue_style( 'color-picker-styling', plugins_url( 'admin/style-color-picker.css', __FILE__, false, false ) );

				wp_enqueue_script( 'enable-color-picker', plugins_url( 'admin/enable-color-picker.js', __FILE__, array( 'wp-color-picker' ), false, true ) );

			}

		}
	}

//	add_action( 'wp_loaded', array( __CLASS__, 'load' ), 9 );
endif; // class_exists( 'Menu_Item_Custom_Fields' )
new Menu_Item_Custom_Fields();
require_once dirname( __FILE__ ) . '/fields/menu-item-custom-fields.php';

//require_once dirname( __FILE__ ) . '/menu-item-custom-fields-colors.php';
require_once dirname( __FILE__ ) . '/WPDev_Display_Menu.php';