<?php 

$auxjson = [];


if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['PATH_INFO'] == "/graph") {

	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata, true);	


	if (isset($request['idade']) && isset($request['valor']) && isset($request['mes']) && isset($request['ano'])) {
		//checar os parametros
		$ano = $request['ano'];
		$mes = $request['mes'];
		$valor = $request['valor'];
		$idade = $request['idade'];

		$dbconnection = mysqli_connect("localhost", "root", "", "hospitais");

		$sql = "INSERT INTO consultas (ano, mes, valor, idade)
				VALUES ($ano, $mes, $valor, $idade)";

		if ($result = mysqli_query($dbconnection, $sql)) {
			$auxjson['status'] = "Registred";
		} else {
			$auxjson['status'] = "Error: " + mysqli_error($dbconnection);
		}	

		echo json_encode($auxjson);
	}

	else {

		$auxjson['status'] = "Error: Params not given";
		echo json_encode($auxjson);
	}
}

?>