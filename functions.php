<?php

	function theme_styles() {
		//include CSS file
		wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css');
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
		wp_enqueue_style( 'theme-css', get_template_directory_uri() . '/css/theme.css');
		//include JS file
		wp_enqueue_script( 'angular-js', get_template_directory_uri() . '/js/angular.min.js');
		wp_enqueue_script( 'controllers-js', get_template_directory_uri() . '/js/controllers.js');
		wp_enqueue_script( 'directives-js', get_template_directory_uri() . '/js/services.js');
		wp_enqueue_script( 'directives-js', get_template_directory_uri() . '/js/directives.js');
	}
	add_action( 'wp_enqueue_scripts', 'theme_styles' );

	add_action( 'after_switch_theme', 'indyBlog_theme_setup' );
	add_action( 'after_setup_theme', 'indyBlog_theme_setup' );
	function indyBlog_theme_setup() {
	    add_theme_support( 'post-thumbnails');
		$imgCover = get_template_directory_uri().'/images/cover/home.jpg';
		$option = get_option('indyblog_cover_homepage');
  	  	if ($option == '' || !$option) {
  	  		delete_option($optionName);
  	    	add_option($optionName, $imgCover, '', 'yes' );
  	  	}
	}

	function get_avatar_indy_url($user_id, $size) {
	    $avatar_url = get_avatar($user_id, $size);
		$src = (string) reset(simplexml_import_dom(DOMDocument::loadHTML($avatar_url))->xpath("//img/@src"));
		return $src;
	}

	add_filter( 'wp_title', 'filter_wp_title' );
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
			'title' => '<span class="ab-icon"></span><span class="ab-label">จัดการธีม indyReview</span>',
			'href' => get_template_directory_uri().'/manager',
		);
		$wp_admin_bar->add_node($args);
	}
	add_action('admin_bar_menu', 'custom_toolbar_link', 40);

	function custom_wp_toolbar_css_admin() {
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
		wp_enqueue_style( 'theme-stylde', get_template_directory_uri() . '/css/custom-wp-toolbar-link.css');
	}
	add_action( 'admin_enqueue_scripts', 'custom_wp_toolbar_css_admin' );
	add_action( 'wp_enqueue_scripts', 'custom_wp_toolbar_css_admin' );

	function arphabet_widgets_init() {
		register_sidebar( array(
			'name'          => 'Footer Widget (indyBlog)',
			'id'            => 'footer_widget',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="rounded">',
			'after_title'   => '</h2>',
		) );
	}
	add_action( 'widgets_init', 'arphabet_widgets_init' );

	class Footer_contact_widget extends WP_Widget {
	    function __construct() {
			 parent::__construct(false, $name = __('Footer Contact (indyBlog)'));
	    }
	    function form($instance) {
			include(locate_template('template-parts/footer_contact_form.php'));
	    }
	    function update($new_instance, $instance) {
			$instance['facebook_status'] = isset($new_instance['facebook_status']) ? 1 : 0;
			$instance['facebook_url'] = trim(strip_tags($new_instance['facebook_url']));
			$instance['twitter_status'] = isset($new_instance['twitter_status']) ? 1 : 0;
			$instance['twitter_url'] = trim(strip_tags($new_instance['twitter_url']));
			$instance['google_status'] = isset($new_instance['google_status']) ? 1 : 0;
			$instance['google_url'] = trim(strip_tags($new_instance['google_url']));
			$instance['instagram_status'] = isset($new_instance['instagram_status']) ? 1 : 0;
			$instance['instagram_url'] = trim(strip_tags($new_instance['instagram_url']));
    		return $instance;
	    }
	    function widget($args, $instance) {
			include(locate_template('template-parts/footer_contact.php'));
	    }
	}
	add_action( 'widgets_init', function() {
		register_widget( 'Footer_contact_widget' );
	} );


	function set_post_views($postID) {
		$count_key = 'post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if ($count == '') {
			$count = 1;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '1');
		} else {
			$count++;
			update_post_meta($postID, $count_key, $count);
		}
	}

	function get_post_views($postID) {
		$count_key = 'post_views_count';
	  	$count = get_post_meta($postID, $count_key, true);
	  	if ($count == '') {
	  		delete_post_meta($postID, $count_key);
	    	add_post_meta($postID, $count_key, '1');
	    	return "1";
	  	}
	  	return $count;
	}

	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

	function find_youtube_ID ($post_content) {
		$pos = strpos($post_content, "www.youtube.com/embed/");
		if(!empty($pos))
			$code_youtube = substr($post_content, $pos+22, 11);
		return $code_youtube;
	}

	function get_post_image_url ($postID, $size) {
		if (get_post_thumbnail_id($postID)) {
			$attachmentID = get_post_thumbnail_id($postID);
		} else {
			$images = get_posts(
					array(
							'post_type'      => 'attachment',
							'post_mime_type' => 'image',
							'post_parent'    => $postID,
							'orderby'        => 'ID',
							'order'          => 'ASC',
							'posts_per_page' => 1,
					)
			);
			$attachmentID = $images[0]->ID;
		}
		$pic = wp_get_attachment_image_src( $attachmentID, $size );
		if ($pic == null) {
			$youtube_ID = find_youtube_ID(get_post_field('post_content', $postID));
			if ($youtube_ID) {
				if ($size == "large")
					$pic = array("https://img.youtube.com/vi/".$youtube_ID."/sddefault.jpg", 640, 480);
				else if ($size == "medium")
					$pic = array("https://img.youtube.com/vi/".$youtube_ID."/hqdefault.jpg", 480, 360);
				else {
					$pic = array("https://img.youtube.com/vi/".$youtube_ID."/mqdefault.jpg", 320, 180);
				}
			} else {
				$pic = array(get_template_directory_uri()."/images/no-image.png", 250, 172);
			}
		}
		return $pic;
	}

	add_filter( 'comment_form_default_fields', 'bootstrap3_comment_form_fields' );
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

	add_filter( 'comment_form_defaults', 'bootstrap3_comment_form' );
	function bootstrap3_comment_form( $args ) {
	    $args['comment_field'] = '<div class="form-group comment-form-comment">
	            <label for="comment">' . _x( 'Comment', 'noun' ) . '</label>
	            <textarea class="form-control" id="comment" name="comment" cols="45" rows="4" aria-required="true"></textarea>
	        </div>';
	    $args['class_submit'] = 'btn btn-default'; // since WP 4.1

	    return $args;
	}

	function sidebar_new_category($catID, $postID, $limit) {
		include(locate_template('template-parts/sidebar_new_cat.php'));
	}

	function share_social($postID) {
		include(locate_template('template-parts/share.php'));
	}

	function search_form() {
		include(locate_template('template-parts/search_form.php'));
	}

	function nav_bar($type) {
		if ($type == "lg") {
			get_template_part('template-parts/nav_lg');
		} else if ("xs") {
			get_template_part('template-parts/nav_xs');
		}
	}

	function indyblog_pagination() {
		get_template_part('template-parts/pagination');
	}

	function footer_widget() {
		get_template_part('template-parts/footer_widget');
	}

	function copyright() {
		get_template_part('template-parts/copyright');
	}

	function get_list_indyblog($optionName) {
		$option = get_option($optionName);
		if ($option != '') {
			$option = explode(",", $option);
			return $option;
		}
		return array();
	}

	function set_list_indyblog($optionName, $strList) {
		$option = get_option($optionName);
  	  	if ($option == '') {
  	  		delete_option($optionName);
  	    	add_option($optionName, $strList, '', 'yes' );
  	  	} else {
  	    	update_option($optionName, $strList);
  	  	}
	}

	function get_cover_image($catID) {
		$keyName = 'indyblog_cover_image';
		$coverUrl = get_term_meta($catID, $keyName, true);
		return $coverUrl;
	}

	function set_cover_image($catID, $imgUrl) {
		$keyName = 'indyblog_cover_image';
		$coverUrl = get_term_meta($catID, $keyName, true);
		if ($coverUrl == '') {
  	  		delete_term_meta($catID, $keyName, '');
  	    	add_term_meta($catID, $keyName, $imgUrl, false);
  	  	} else {
  	    	update_term_meta($catID, $keyName, $imgUrl);
  	  	}
	}

	function get_cover_homepage() {
		$optionName = 'indyblog_cover_homepage';
		$coverUrl = get_option($optionName);
		if (!$coverUrl) {
			return '';
		}
		return $coverUrl;
	}

	function set_cover_homepage($imgUrl) {
		$optionName = 'indyblog_cover_homepage';
		$option = get_option($optionName);
  	  	if ($option == '' || !$option) {
  	  		delete_option($optionName);
  	    	add_option($optionName, $imgUrl, '', 'yes' );
  	  	} else {
  	    	update_option($optionName, $imgUrl);
  	  	}
	}

	function useComment($type) {
		$list = get_list_indyblog('indyblog_comment_style');
		if ($type == "wordpress") {
			if (isset($list[0]) && $list[0] == 1) {
				return true;
			}
			return false;
		} else if ($type == "facebook") {
			if (isset($list[1]) && $list[1] == 1) {
				return true;
			}
			return false;
		}
		return false;
	}
?>
