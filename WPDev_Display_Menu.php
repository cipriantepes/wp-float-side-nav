<?php
/**
 * Created by PhpStorm.
 * User: Cippo
 * Date: 11/5/2014
 * Time: 1:42 AM
 */

if ( ! class_exists( 'WPDev_Display_Menu' ) ) {
	class WPDev_Display_Menu {

		public function __construct() {
			add_action( 'wp_footer', array( $this, 'display_menu' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 99 );
		}

		public function preg_array_key_exists_here( $pattern, $array ) {
			$keys = array_keys( $array );

			return (int) preg_grep( $pattern, $keys );
		}


		public function enqueue_scripts() {


			$menu_name = 'side-float-menu';

			if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
				$menu       = wp_get_nav_menu_object( $locations[ $menu_name ] );
				$menu_items = wp_get_nav_menu_items( $menu->term_id );
				$styles     = [];
				$css        = [];
				$normal     = '';
				//var_dump($menu_items);


				foreach ( $menu_items as $item ) {
					/*$bgc = get_post_meta( $item->db_id, 'menu-item-background-color', true );
					$bch = get_post_meta( $item->db_id, 'menu-item-background-hover', true );
					$txc = get_post_meta( $item->db_id, 'menu-item-text-color', true );
					$txh = get_post_meta( $item->db_id, 'menu-item-text-hover', true );

					if ( isset( $bgc ) )
						$styles[] = "background-color: {$bgc};";
					if ( isset( $txc ) )
						$styles[] = "color: {$txc};";

					//if ( isset( $meta['menu-item-background-color'] ) )
					//	$styles[] = "background-color: {$meta['menu-item-background-color']}";
					//var_dump($meta['menu-item-background-color']);
					//var_dump($meta);*/

					$meta = get_post_meta( $item->db_id );

//					var_dump( $meta );

					if ( $this->preg_array_key_exists_here( '/^menu-item-/', $meta ) ) {

						if ( isset( $meta['menu-item-background-color'][0] ) ) {
							$css[0][] = "background-color: {$meta['menu-item-background-color'][0]}";
						}
						if ( isset( $meta['menu-item-text-color'][0] ) ) {
							$css[0][] = "color: {$meta['menu-item-text-color'][0]}";
						}

						if ( isset( $meta['menu-item-background-color-hover'][0] ) ) {
							$css[1][] = "background-color: {$meta['menu-item-background-color-hover'][0]}";
						}
						if ( isset( $meta['menu-item-text-color-hover'][0] ) ) {
							$css[1][] = "color: {$meta['menu-item-text-color-hover'][0]}";
						}


						/*foreach ( $meta as $key => $val ) {
							if ( preg_match( '/^menu-item/', $key, $matches ) ) {
								$val = $val[0];
								$css[] = "{$key}: {$val}";
							}
						}*/

						$normal = join( "; ", $css[0] );
						$hover  = join( "; ", $css[1] );

						$styles[] = ".menu-item-{$item->db_id} a { {$normal} }";
						$styles[] = ".menu-item-{$item->db_id} a:hover { {$hover} }";
					}

					$css = '';

				}

				//var_dump( $styles );

				$styles = join( "\n", $styles );
			}

			$styles = <<<CSS

{$styles}

CSS;

			wp_enqueue_style( 'fsn-styles', plugins_url( '/css/styles.css', __FILE__ ) );
			wp_add_inline_style( 'fsn-styles', $styles );
			wp_enqueue_script( 'fsn-scripts', plugins_url( '/js/scripts.js', __FILE__ ), null, null, true );
		}


		public function display_menu() {
			//if ( has_nav_menu('side-float-menu') && wp_get_nav_menu_items( 'side-float-menu' ) ) {
			wp_nav_menu( array(
				'menu'       => 'side-float-menu',
				'menu_class' => 'side-float-menu',
				//'walker' => new FSN_Walker()
			) );

			//}

		}

	}

	new WPDev_Display_Menu();
}