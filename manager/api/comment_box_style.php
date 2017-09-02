<?php
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    require_once ('../../../../../wp-config.php');

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && current_user_can('manage_options')) {
        $json = file_get_contents('php://input');
        $obj = json_decode($json);
        $data = (array) $obj;

        $arrComment = get_list_indyblog('indyblog_comment_style');

        echo json_encode(array(
            "result" => 0,
            "data" => $arrComment
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

        set_list_indyblog('indyblog_comment_style', $data['strList']);

        echo json_encode(array(
            "result" => 0,
            "data" => "success"
		));

	} else {
		exit(1);
	}
?>
