<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Theme_Enqueue' ) ) :

	class Theme_Enqueue {
		function __construct() {

		}

		function init() {
            /*************** Actions ***************/
            add_action( 'init', [ $this, 'get_theme_config' ] );
            add_action( 'admin_bar_menu', [ $this, 'custom_toolbar_link' ], 40 );
            add_action( 'admin_enqueue_scripts', [ $this, 'custom_wp_toolbar_css_admin' ] );
            add_action( 'wp_enqueue_scripts', [ $this, 'custom_wp_toolbar_css_admin' ] );	
            add_action( 'wp_enqueue_scripts', [ $this, 'theme_styles' ] );
            add_action( 'wp_enqueue_scripts', [ $this, 'theme_scripts' ] );
            add_action( 'wp_footer', [ $this, 'footer_script' ] );
            add_action( 'rest_api_init', array('IndyAPI', 'init_routes') ); 
            remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
            /*************** Filter ***************/
            add_filter( 'wp_title', [ $this, 'filter_wp_title' ] );
            add_filter( 'comment_form_default_fields', [ $this, 'bootstrap3_comment_form_fields' ] );
            add_filter( 'comment_form_defaults', [ $this, 'bootstrap3_comment_form' ] );
        }
        
        function theme_styles() {
            wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
            wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css');
            wp_enqueue_style( 'slide-css', get_template_directory_uri() . '/css/slide.css');
            wp_enqueue_style( 'theme-css', get_template_directory_uri() . '/css/theme.css');
        }

        function theme_scripts() {
            wp_enqueue_script( 'locale-js', get_template_directory_uri() . '/js/locale.js');
            wp_enqueue_script( 'jquery-js', get_template_directory_uri() . '/js/jquery.min.js');
            wp_enqueue_script( 'slide-js', get_template_directory_uri() . '/js/slide.js');
            wp_enqueue_script( 'angular-js', get_template_directory_uri() . '/js/angular.min.js');
        }
    
        function footer_script() {
            wp_enqueue_script( 'controllers-js', get_template_directory_uri() . '/js/controllers.js');
            wp_enqueue_script( 'services-js', get_template_directory_uri() . '/js/services.js');
            wp_enqueue_script( 'directives-js', get_template_directory_uri() . '/js/directives.js');
            wp_enqueue_script( 'combined-script', get_template_directory_uri() . '/js/script.js');
        }

        function get_theme_config() {
            global $theme_lang;
            $theme_lang = get_locale();
            $config = array(
                "site_url" => site_url(),
                "theme_url" => get_template_directory_uri(),
                "lang" => $theme_lang,
                "api" => site_url().'/wp-json/indy-review/v1'
            );
            return json_encode($config);
        }

        function get_avatar_indy_url($user_id, $size) {
            $avatar_url = get_avatar($user_id, $size);
            $src = (string) reset(simplexml_import_dom(DOMDocument::loadHTML($avatar_url))->xpath("//img/@src"));
            return $src;
        }
    
        function filter_wp_title( $title ) {
            global $page, $paged;
            if ( is_feed() )
                return $title;
            $site_description = get_bloginfo( 'description' );
            $filtered_title = $title . get_bloginfo( 'name' );
            $filtered_title .= ( ! empty( $site_description ) && ( is_home() || is_front_page() ) ) ? ' - ' . $site_description: '';
            $filtered_title .= ( 2 <= $paged || 2 <= $page ) ? ' - ' . sprintf( __( 'Page %s' ), max( $paged, $page ) ) : '';
            return $filtered_title;
        }

        function custom_toolbar_link($wp_admin_bar) {
            $args = array(
                'id' => 'manage-variety',
                'title' => '<span class="ab-icon"></span><span class="ab-label">'.__indy('manage_indyreview').'</span>',
                'href' => get_template_directory_uri().'/manager',
            );
            $wp_admin_bar->add_node($args);
        }
    
        function custom_wp_toolbar_css_admin() {
            wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
            wp_enqueue_style( 'theme-stylde', get_template_directory_uri() . '/css/custom-wp-toolbar-link.css');
        }

        function bootstrap3_comment_form_fields( $fields ) {
            $commenter = wp_get_current_commenter();
            $req      = get_option( 'require_name_email' );
            $aria_req = ( $req ? " aria-required='true'" : '' );
            $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
            $fields   =  array(
                'author' => '<div class="form-group comment-form-author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                            '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
                'email'  => '<div class="form-group comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                            '<input class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
            );
            return $fields;
        }
    
        function bootstrap3_comment_form( $args ) {
            $args['comment_field'] = '<div class="form-group comment-form-comment">
                    <label for="comment">' . _x( 'Comment', 'noun' ) . '</label>
                    <textarea class="form-control" id="comment" name="comment" cols="45" rows="4" aria-required="true"></textarea>
                </div>';
            $args['class_submit'] = 'btn btn-default'; // since WP 4.1
            return $args;
        }
	}

endif;


?>