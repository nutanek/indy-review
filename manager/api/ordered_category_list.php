<?php
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    require_once ('../../../../../wp-config.php');

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && current_user_can('manage_options')) {
        $json = file_get_contents('php://input');
        $obj = json_decode($json);
        $data = (array) $obj;

        $categoryIDArr = get_list_indyblog('indyblog_ordered_categories');
        $arrCategory = array();

        foreach ($categoryIDArr as $id) {
            array_push($arrCategory, array(
                "id" => $id,
                "name" => get_cat_name($id)
            ));
        }

        echo json_encode(array(
            "result" => 0,
            "data" => $arrCategory
        ));

    } else if ($_SERVER['REQUEST_METHOD'] === 'POST' && current_user_can('manage_options')) {
		$json = file_get_contents('php://input');
		$obj = json_decode($json);
		$data = (array) $obj;

        if (!isset($data['strList'])) {
			echo json_encode(array(
                "result" => 1,
				"msg" => "data is not completed"
			));
			exit();
		}

        set_list_indyblog('indyblog_ordered_categories', $data['strList']);

        echo json_encode(array(
            "result" => 0,
            "data" => "success"
		));

	} else {
		exit(1);
	}
?>
