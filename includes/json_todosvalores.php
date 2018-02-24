<?php

header("Content-type: application/json");
$auxjson = [];

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['PATH_INFO'] == '/consults') {

	$dbconnection = mysqli_connect("localhost", "root", "", "hospitais");
	$sql = "SELECT * FROM consultas LIMIT 100";

	if ($result = mysqli_query($dbconnection, $sql)) {		
		$row = [];
		while ($row = mysqli_fetch_array($result)) {
			$auxjson[] = $row;
		}

	} else {
		$auxjson['status'] = 'Error: '.mysqli_error($dbconnection);
	}

	header("Content-type: application/json");
	echo json_encode($auxjson);
} else {
	http_response_code(404);
}


?>