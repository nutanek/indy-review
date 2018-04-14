<?php

class Theme_Helpers {
    function get_avatar_indy_url($user_id, $size) {
	    $avatar_url = get_avatar($user_id, $size);
		$src = (string) reset(simplexml_import_dom(DOMDocument::loadHTML($avatar_url))->xpath("//img/@src"));
		return $src;
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
			$youtube_ID = self::find_youtube_ID(get_post_field('post_content', $postID));
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

	function get_component($name, $data=array()) {
		switch ($name) {
			case 'header':
				self::get_part('header'); break;
			case 'nav-lg':
				self::get_part('nav_lg'); break;
			case 'nav-xs':
				self::get_part('nav_xs'); break;
			case 'slider':
				self::get_part('slider'); break;
			case 'post-item':
				self::include_part('post_item', $data); break;
			case 'posts':
				self::include_part('posts', $data); break;
			case 'social-sharing':
				self::include_part('social_sharing', $data); break;
			case 'new-posts':
				self::include_part('new_posts', $data); break;
			case 'pagination':
				self::get_part('pagination'); break;
			case 'search-form':
				self::get_part('search_form'); break;
			case 'social-following':
				self::get_part('social_following'); break;
			case 'copyright':
				self::get_part('copyright'); break;
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
		$content = preg_replace("/&nbsp;/",'', self::add3dots($content, '...', $num));
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
	
    function base64_url_encode($data) {
		$urlSafeData = strtr(base64_encode($data), '+/', '-_');
		return rtrim($urlSafeData, '='); 
	} 
	
	function base64_url_decode($data) {
		$urlUnsafeData = strtr($data, '-_', '+/');
		$paddedData = str_pad($urlUnsafeData, strlen($data) % 4, '=', STR_PAD_RIGHT);
		return base64_decode($paddedData);
	}
}

?>