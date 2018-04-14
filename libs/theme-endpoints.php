<?php
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

		function gennerate_jwt($payload) {
			$secret_key = constant('AUTH_KEY');						
			$header = array(
				"typ" => "JWT",
    			"alg" => "HS256"
			);
			$headerEncoded = Theme_Helpers::base64_url_encode(json_encode($header));
			$payloadEncoded = Theme_Helpers::base64_url_encode(json_encode($payload));
			$rawSignature = hash_hmac('sha256', "$headerEncoded.$payloadEncoded", $secret_key, true);
			$signatureEncoded = Theme_Helpers::base64_url_encode($rawSignature);
			$jwt = "$headerEncoded.$payloadEncoded.$signatureEncoded";
			return $jwt;
		}

		function verify_jwt($jwt) {
			$secret_key = constant('AUTH_KEY');			
			list($headerEncoded, $payloadEncoded, $signatureEncoded) = explode('.', $jwt);
			$dataEncoded = "$headerEncoded.$payloadEncoded";
			$signature = Theme_Helpers::base64_url_decode($signatureEncoded);
			$rawSignature = hash_hmac('sha256', $dataEncoded, $secret_key, true);
			if (hash_equals($rawSignature, $signature)) {
				return true;
			}
			return false;
		}

		function get_payload_jwt($jwt) {
			$token = explode(".", $jwt);
			return json_decode(Theme_Helpers::base64_url_decode($token[1]), true);
		}

		function can_manage($jwt) {
			if (!$jwt) {
				http_response_code(403);
				exit();
			}
			$data = self::get_payload_jwt($jwt);
			if ($data['isAdmin'] && $data['expireAt'] > time()) {
				// next
			} else {
				http_response_code(403);
				exit();
			}
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
			$the_query = Theme_Helpers::gen_query_post(array(
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
						'image' => Theme_Helpers::get_post_image_url($postid, "medium")[0],
						'title' => get_the_title(),
						'post_time' => get_post_time('j M Y', true),
						'post_url' => esc_url(get_permalink($postid)),
						'content' => Theme_Helpers::gen_summary(get_the_content(), 120),
						'category' => Theme_Helpers::gen_category_detail(get_the_category())					
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
				"tone" => Theme_Helpers::get_tone()
			);
		}

		function set_tone($data) {
			self::can_manage($data['jwt']);
			$tone = $data['tone'];
			update_option("indyreview_tone", $tone);
			return array(
				"result" => "success",
				"tone" => $tone
			);
		}

	}
?>