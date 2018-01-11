<?php 

$auxjson = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['PATH_INFO'] == "/graph") {

	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata, true);

	if ($request['idade'] && $request['valor'] && $request['mes'] && $request['ano']) {
		$auxjson['status'] = "Deu";
		$auxjson['dados'] = $request;
		echo json_encode($auxjson);
	}

	else {

		$auxjson['status'] = "Params not given";
		echo json_encode($auxjson);
	}
}

?>