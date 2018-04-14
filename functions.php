<?php
	include_once 'libs/theme-enqueue.php';
	include_once 'libs/theme-helpers.php';
	include_once 'libs/theme-locale.php';		
	include_once 'libs/theme-endpoints.php';	

	$Theme_Enqueue = new Theme_Enqueue();
	$Theme_Enqueue->init();

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
