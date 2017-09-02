<?php
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    
    require_once ('../../../../../wp-config.php');

	if ($_SERVER['REQUEST_METHOD'] === 'GET' && current_user_can('manage_options')) {
		$json = file_get_contents('php://input');
		$obj = json_decode($json);
		$data = (array) $obj;

        $categories = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'term_taxonomy WHERE taxonomy="category" ORDER BY term_id', ARRAY_A );
        $arrCategory = array();

        foreach ($categories as $cat) {
            array_push($arrCategory, array(
                "id" => $cat["term_id"],
                "name" => get_cat_name($cat["term_id"])
            ));
        }

        $list = get_the_category();
        echo json_encode(array(
            "result" => 0,
            "data" => $arrCategory
		));

	} else {
		exit(1);
	}
?>
