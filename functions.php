<?php
	include_once 'libs/theme-enqueue.php';
	include_once 'libs/theme-helpers.php';
	include_once 'libs/theme-endpoints.php';	

	$Theme_Enqueue = new Theme_Enqueue();
	$Theme_Enqueue->init();

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
?>
