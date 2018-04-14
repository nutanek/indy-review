<?php
	/*************** Actions ***************/
	add_action( 'init', 'get_theme_config' );
	add_action( 'admin_bar_menu', 'custom_toolbar_link', 40 );
	add_action( 'admin_enqueue_scripts', 'custom_wp_toolbar_css_admin' );
	add_action( 'wp_enqueue_scripts', 'custom_wp_toolbar_css_admin' );	
	add_action( 'wp_enqueue_scripts', 'theme_styles' );
	add_action( 'wp_footer', 'footer_script' );
	add_action( 'rest_api_init', array('IndyAPI', 'init_routes') ); 
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	/*************** Filter ***************/
	add_filter( 'wp_title', 'filter_wp_title' );
	add_filter( 'comment_form_default_fields', 'bootstrap3_comment_form_fields' );
	add_filter( 'comment_form_defaults', 'bootstrap3_comment_form' );

	function theme_styles() {
		//include CSS file
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
		wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css');
		wp_enqueue_style( 'slide-css', get_template_directory_uri() . '/css/slide.css');
		wp_enqueue_style( 'theme-css', get_template_directory_uri() . '/css/theme.css');
		//include JS file
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

	function __indy($text) {
		global $theme_lang;
		if ($theme_lang == 'th' || $theme_lang == 'th_TH') {
			include(locate_template('languages/th.php'));
			if (isset($lang_th[$text])) {
				return $lang_th[$text];
			} else {
				return $text;
			}
		} else {
			include(locate_template('languages/en.php'));
			if (isset($lang_en[$text])) {
				return $lang_en[$text];
			} else {
				return $text;
			}
		}
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
			$images = get_posts(array(
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
				'post_parent'    => $postID,
				'orderby'        => 'ID',
				'order'          => 'ASC',
				'posts_per_page' => 1,
			));
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
				$pic = array("", 0, 0);
			}
		}
		return $pic;
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

	function get_component($name, $data=array()) {
		switch ($name) {
			case 'header':
				get_part('header'); break;
			case 'nav-lg':
				get_part('nav_lg'); break;
			case 'nav-xs':
				get_part('nav_xs'); break;
			case 'slider':
				get_part('slider'); break;
			case 'post-item':
				include_part('post_item', $data); break;
			case 'posts':
				include_part('posts', $data); break;
			case 'social-sharing':
				include_part('social_sharing', $data); break;
			case 'new-posts':
				include_part('new_posts', $data); break;
			case 'pagination':
				get_part('pagination'); break;
			case 'search-form':
				get_part('search_form'); break;
			case 'social-following':
				get_part('social_following'); break;
			case 'copyright':
				get_part('copyright'); break;
			default:
				# code...
				break;
		}
	}

	function include_part($name, $data=array()) {
		$path = 'template-parts';
		include(locate_template($path.'/'.$name.'.php'));
	}

	function get_part($name) {
		$path = 'template-parts';
		get_template_part($path.'/'.$name);
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
	
	function add3dots($string, $repl, $limit) {
		if(strlen($string) > $limit) {
			return mb_substr($string, 0, $limit) . $repl; 
		} else {
			return $string;
		}
	}

	function gen_summary($content, $num) {
		$content = wp_strip_all_tags($content);
		$content = preg_replace("/&nbsp;/",'', add3dots($content, '...', $num));
		return $content;
	}

	function gen_category_detail($detail) {
		$category = array();
		foreach($detail as $key=>$value) {
			array_push($category, array(
				'id' => $value->cat_ID,
				'name' => $value->cat_name,
				'url' => esc_url(get_category_link($value->cat_ID))
			));
		}
		return $category;
	}

	function gen_query_post($data) {
		$catID = $data['catID'];
		$orderBy = $data['orderBy'];
		$page = $data['page'];
		$tag = $data['tag'];
		$search = $data['search'];
		$numberOfPost = $data['numberOfPost'];
		$exclude = $data['exclude'];

		$options = array(
			'posts_per_page' => get_option('posts_per_page'),
			'paged' => $page,
		);
		if ($catID !== 'all') {
			$options['cat'] = $catID;
		}
		if ($orderBy == 'score') {
			$options['orderby'] = 'meta_value_num';
			$options['order'] = 'DESC';
			$options['meta_query'] = array(
				'relation' => 'OR',
				array(
					'key' => 'indyreview_rating_avg',
					'compare' => 'NOT EXISTS'
				),
				array(
					'key' => 'indyreview_rating_avg',
					'type' => 'numeric'
				)
			);
		}
		if (isset($tag)) {
			$options['tag'] = $tag;
		}
		if (isset($search)) {
			$options['s'] = $search;
		}
		if (isset($numberOfPost)) {
			$options['posts_per_page'] = $numberOfPost;
		}
		if (isset($exclude)) {
			$options['post__not_in'] = $exclude;
		}
		$the_query = new WP_Query($options);

		return $the_query;
	}

	function gen_background_color($id) {
		$colors = array('34495e', '674172', '446CB3', '019875', '336E7B', '792117', '6C7A89', '381905');
		$size = sizeof($colors);
		$result = '#'.$colors[$id % $size];
		return $result;
	}

	function get_social() {
		$optionName = 'indyreview_socials';
		$socials = get_option($optionName);
		if ($socials) {
			$socials = (array) json_decode($socials);
			return $socials;
		}
		return null;
	}

	function get_logo() {
		$logo = get_option("indyreview_logo");
		if (!$logo) {
			return get_template_directory_uri().'/images/logo.png';
		}
		return $logo;
	}

	// function set_arr_menu() {
	// 	$arr = array(
	// 		array(
	// 			"type" => "cat",
	// 			"data" => 1
	// 		),
	// 		array(
	// 			"type" => "link",
	// 			"name" => "เกี่ยวกับเรา",
	// 			"data" => "https://www.indytheme.com"
	// 		),
	// 		array(
	// 			"type" => "cat",
	// 			"data" => 2
	// 		)
	// 	);
	// 	update_option("indyreview_menu", json_encode($arr));
	// }

	function get_menu() {
		$menus = get_option("indyreview_menu");
		$menus = (array) json_decode($menus);
		$result = array();
		foreach ($menus as $menu) {
			$menu = (array) $menu;
			if ($menu["type"] == "cat") {
				array_push($result, array(
					"name" => get_cat_name($menu["data"]),
					"url" => esc_url(get_category_link($menu["data"]))
				));
			} else {
				array_push($result, array(
					"name" => $menu["name"],
					"url" => $menu["data"]
				));
			}
		}
		return $result;
	}

	function get_tone() {
		$tone = get_option("indyreview_tone");
		if ($tone) {
			return $tone;
		}
		return 'pearl';
	}

	function get_nut() {
		return array(
			"result" => "ss"
		);
	}
	

	/***************** API *****************/
	class IndyAPI {
		private static $route = 'indy-review/v1';

		function init_routes() {
			self::register('/rating/(?P<post_id>\d+)', 'get_rating', 'GET');
			self::register('/rating/avg/(?P<post_id>\d+)', 'get_rating_avg', 'GET');
			self::register('/rating/(?P<post_id>\d+)', 'push_rating', 'POST');
			self::register('/posts', 'get_posts', 'POST');
			self::register('/logo', 'upload_logo', 'POST');
			self::register('/tone', 'get_tone', 'get');
			self::register('/tone', 'set_tone', 'post');
		}

		static function register($path, $function, $method) {
			register_rest_route( self::$route, $path, array(
				'methods' => $method,
				'callback' => array('IndyAPI', $function),
			) );
		}

		function get_rating($data) {
			$postID = $data['post_id'];
			$rating = get_post_meta($postID, 'indyreview_rating', true);
			
			if ($rating != null) {
				$rating = array_map('intval', explode(',', $rating));
				return array(
					"result" => 0,
					"rating" => $rating
				);
			} else {
				return array(
					"result" => 1,
					"msg" => "rating of post ID ".$postID." not found"
				);
			}
		}

		function get_rating_avg($data) {
			$postID = $data['post_id'];
			$ratingAvg = get_post_meta($postID, 'indyreview_rating_avg', true);
			if ($ratingAvg != null) {
				return array(
					"result" => 0,
					"avg" => floatval($ratingAvg),
					"is_user_logged_in" => wp_get_current_user()->ID
				);
			} else {
				return array(
					"result" => 1,
					"msg" => "rating avg of post ID ".$postID." not found"
				);
			}
		}

		function push_rating($data) {
			$postID = $data['post_id'];
			$score = $data['score'];
			$rating = get_post_meta($postID, 'indyreview_rating', true);

			if ($rating != null) {
				$rating = array_map('intval', explode(',', $rating));
				$rating[$score-1] += 1;
				$str = implode(",", $rating); 
				update_post_meta($postID, 'indyreview_rating', $str);
			} else {
				$rating = array(0,0,0,0,0);
				$rating[$score-1] += 1;
				$str = implode(",", $rating); 
				// delete_option($optionName);
				add_post_meta($postID, 'indyreview_rating', $str, 'yes');
			}

			$scores = array(0, 2.5, 5, 7.5, 10);
			$set = 0;
			$divisor = 0;
			foreach ($rating as $key=>$value) {
				$set += ($value * $scores[$key]);
				$divisor += $value;
			}
			$ratingAvg = number_format((float)($set/$divisor), 1, '.', '');
			update_post_meta($postID, 'indyreview_rating_avg', $ratingAvg);
			
			return array(
				"result" => 0,
				"data" => array(
					"rating" => $rating,
					"avg" => floatval($ratingAvg)
				)
			);
		}

		function get_posts($data) {
			$the_query = gen_query_post(array(
				'catID' => $data['catID'],
				'orderBy' => $data['orderBy'],
				'page' => $data['page'],
				'tag' => $data['tag'],
				'search' => $data['search'],
			));

			if ( $the_query->have_posts() ) {
				$posts = array();
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
                    $postid = get_the_ID();
					array_push($posts, array(
						'post_ID' => $postid,
						'image' => get_post_image_url($postid, "medium")[0],
						'title' => get_the_title(),
						'post_time' => get_post_time('j M Y', true),
						'post_url' => esc_url(get_permalink($postid)),
						'content' => gen_summary(get_the_content(), 120),
						'category' => gen_category_detail(get_the_category())					
					));
				}
				return array(
					"result" => 0,
					"data" => $posts
				);
			} else {
				return array(
					"result" => 1,
					"msg" => "posts not found"
				);
			}
		}

		function upload_logo($data) {
			if ( ! function_exists( 'wp_handle_upload' ) ) {
				require_once( ABSPATH . 'wp-admin/includes/file.php' );
			}
			$uploadedfile = $_FILES['file'];
			$upload_overrides = array(
				'test_form' => false
			);
			$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
			if ( $movefile && ! isset( $movefile['error'] ) ) {
				update_option("indyreview_logo", $movefile['url']);
				return array(
					"result" => 0,
					"url" => $movefile['url']
				);
			} else {
				return array(
					"result" => 1
				);
			}
		}

		function get_tone() {
			return array(
				"result" => 0,
				"tone" => get_tone()
			);
		}

		function set_tone($data) {
			$tone = $data['tone'];

			// wp_verify_nonce

			

			return array(
				"result" => $data['_nonce'],
				"tone22" => wp_get_current_user()->user_login
			);
			// if (!current_user_can('manage_options')) {
			// 	http_response_code(403);
			// 	exit();
			// }
			// update_option("indyreview_tone", $tone);
			// return array(
			// 	"result" => 0,
			// 	"tone" => $tone
			// );
			return get_nut();
		}

	}
?>
